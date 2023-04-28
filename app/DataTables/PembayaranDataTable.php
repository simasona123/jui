<?php

namespace App\DataTables;

use App\Models\Pembayaran;
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
            ->addColumn('aksi', 'pembayarans.datatables_actions')
            ->rawColumns(['status', 'aksi']);
        
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
            // ->addAction(['width' => '120px', 'printable' => false])
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

        $aksi = Column::make('aksi')
                ->searchable(false)
                ->orderable(false);

        $kode_booking = Column::make('kode_booking');

        $id = Column::make('id')
            ->visible(false);

        return [
            $id,
            $kode_booking,
            'tanggal_bayar',
            'jumlah_transaksi',
            $status,
            $aksi,
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
