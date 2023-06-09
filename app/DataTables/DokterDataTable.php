<?php

namespace App\DataTables;

use App\Models\Dokter;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class DokterDataTable extends DataTable
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

        $dataTable->addColumn('user', function(Dokter $dokter){
            return $dokter->user->full_name;
        });

        return $dataTable->addColumn('action', 'dokter.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dokter $model)
    {
        return $model::with('user')->select(
            'dokter.*',
            'users.*',
            'dokter.id as dokter_id',
            'users.id as user_id',
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
        $jenis_kelamin = Column::make('jenis_kelamin')
            ->title('Jenis Kelamin')
            ->searchable(false)
            ->orderable(false);

        
        $nip = Column::make('nip')
            ->title('NIP')
            ->searchable(false)
            ->orderable(false);

        
        $spesialis = Column::make('spesialis')
            ->title('Spesialis')
            ->searchable(false)
            ->orderable(false);

        $user = Column::make('user')->title('Nama Dokter')->name('user.full_name');

        
        return [
            $user,
            $spesialis,
            $nip,
            $jenis_kelamin,
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'dokter_datatable_' . time();
    }
}
