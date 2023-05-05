<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\Dokter;
use App\Models\JadwalPraktik;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class PembayaranDataTable extends DataTable
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

        $dataTable = $dataTable
            ->addColumn('kode_booking', function($pembayaran){
                return $pembayaran->booking->kode_booking;
            })
            ->addColumn('status', 'pembayarans.datatables_status')
            ->addColumn('action', 'pembayarans.datatables_actions')
            ->rawColumns(['status', 'action']);
        
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pembayaran $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pembayaran $model)
    {
        $user = Auth::user();
        if($user->getRoleNames()[0] == 'klien'){
            return $model::with('booking')->where('user_id', $user->id);
        }
        else if($user->getRoleNames()[0] == 'dokter-hewan'){
            $dokter_id = Dokter::where('user_id', $user->id)->first()->id;
            $jadwal_praktik = JadwalPraktik::where('dokter_id', $dokter_id)->pluck('id');
            $booking = Booking::whereIn('jadwal_praktik_id', $jadwal_praktik)->pluck('id');

            return $model::with(['booking' => function($q) use ($jadwal_praktik) {
                return $q->whereIn('jadwal_praktik_id', $jadwal_praktik);
            }])->whereIn('booking_id', $booking);
        }
        return $model::with('booking');
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
        $status = Column::make('status')
                ->searchable(false)
                ->orderable(false);

        $kode_booking = Column::make('kode_booking');

        $id = Column::make('id')
            ->visible(false);

        $tanggal_bayar= Column::make('tanggal_bayar')
            ->title('Tanggal Masuk')
            ->searchable(false)
            ->orderable(false)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()} 
                \${String(data.getHours()).padStart(2, '0')}:\${String(data.getMinutes()).padStart(2, '0')}:00 WIB`;
            }");
            

        return [
            $id,
            $kode_booking,
            $tanggal_bayar,
            'jumlah_transaksi',
            $status,
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'pembayarans_datatable_' . time();
    }
}
