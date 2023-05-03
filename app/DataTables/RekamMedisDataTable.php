<?php

namespace App\DataTables;

use App\Models\Dokter;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class RekamMedisDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'rekam_medis.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RekamMedis $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RekamMedis $model)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        if($role == 'dokter-hewan'){
            $dokter = Dokter::where('user_id', $user->id)->first();
            return $model->where('dokter_id', $dokter->id);
        }
        return $model->newQuery();
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

        $tgl_pemeriksaan= Column::make('tgl_pemeriksaan')
            ->title('Tanggal Pemeriksaan')
            ->searchable(false)
            ->orderable(false)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()} 
                \${String(data.getHours()).padStart(2, '0')}:\${String(data.getMinutes()).padStart(2, '0')}:00 WIB`;
            }");

        $result =  [
            'nomor_rekam_medis',
            'keluhan',
            'diagnosis',
            'prognosa',
            $tgl_pemeriksaan,
            'keterangan'
        ];
        
        // if(Auth::user()->getRoleNames()[0] != 'dokter-hewan'){
        //     array_splice( $result, 3, 0, 'dokter_id'); 
        // }

        return $result;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'rekam_medis_datatable_' . time();
    }
}
