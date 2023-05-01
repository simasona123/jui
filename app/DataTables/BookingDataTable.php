<?php

namespace App\DataTables;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class BookingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        
        $dataTable
            ->addColumn('pasien', function(Booking $booking){
            return [
                $booking->pasien->id, $booking->pasien->nama_hewan, $booking->pasien->jenis_hewan,
            ];
            })
            ->addColumn('jadwal_praktik', function(Booking $booking){
                return [
                    $booking->jadwal_praktik->id, $booking->jadwal_praktik->tanggal_masuk
                ];
            })
            ->orderColumn('jadwal_praktik', function($query, $tanggal_masuk){
                return $query->orderBy('tanggal_masuk', $tanggal_masuk);
            })
            ->addColumn('status_booking', 'bookings.datatables_status')
            ->addColumn('action', 'bookings.datatables_actions')
            ->rawColumns(['action','status_booking'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Booking $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Booking $model)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        $dokter = $user->dokter;
        if($role == 'klien'){
            return $model::with(['pasien', 'jadwal_praktik', 'status'])
            ->whereRelation('pasien', 'user_id', $user->id)
            ->leftJoin('jadwal_praktik', 'booking.jadwal_praktik_id', '=', 'jadwal_praktik.id')
            ->select(
                'booking.*',
                'jadwal_praktik.*',
                'booking.id as booking_id',
                'jadwal_praktik.id as jadwal_praktik_id'
            );
        }if($role == 'dokter-hewan'){
            return $model::with(['pasien', 'jadwal_praktik', 'status'])
            ->leftJoin('jadwal_praktik', 'booking.jadwal_praktik_id', '=', 'jadwal_praktik.id')
            ->where('jadwal_praktik.dokter_id', $dokter->id)
            ->select(
                'booking.*',
                'jadwal_praktik.*',
                'booking.id as booking_id',
                'jadwal_praktik.id as jadwal_praktik_id'
            );
        }
        return $model::with(['pasien', 'jadwal_praktik', 'status'])
            ->leftJoin('jadwal_praktik', 'booking.jadwal_praktik_id', '=', 'jadwal_praktik.id')
            ->select(
                'booking.*',
                'jadwal_praktik.*',
                'booking.id as booking_id',
                'jadwal_praktik.id as jadwal_praktik_id'
            );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // Enable Buttons as per your need
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $pasien = Column::make('pasien')
            ->orderable(false)
            ->render("`<a href='/admin/pasien/\${data[0]}'>\${data[1]} \${data[2]}</a>`");

        $jadwal_praktik = Column::make('jadwal_praktik')
            ->orderable(true)
            ->render(" function (){
                let date = new Date(data[1]);
                let time = `\${String(date.getDate()).padStart(2, '0')}-\${String(date.getMonth()+1).padStart(2, '0')}-\${date.getFullYear()} \${String(date.getHours()).padStart(2, '0')}:\${String(date.getMinutes()).padStart(2, '0')}:00`;
                return `<a href='/jadwal-praktik/\${data[0]}'>\${time}</a>`
            }");
            
        $status_booking = Column::make('status_booking')
                ->searchable(false)
                ->orderable(false);
        return [
            $jadwal_praktik,
            $pasien,
            'kode_booking',
            $status_booking,
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'bookings_datatable_' . time();
    }
}
