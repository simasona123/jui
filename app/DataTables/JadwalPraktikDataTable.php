<?php

namespace App\DataTables;

use App\Models\Dokter;
use App\Models\JadwalPraktik;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class JadwalPraktikDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'jadwal_praktik.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\JadwalPraktik $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JadwalPraktik $model)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        if($role == 'dokter-hewan'){
            $dokter_id = Dokter::where('user_id', $user->id)->first()->id;
            return $model::where('dokter_id', $dokter_id);
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
        $tanggal_masuk = Column::make('tanggal_masuk')
            ->title('Tanggal Masuk')
            ->searchable(false)
            ->orderable(true)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()} 
                \${String(data.getHours()).padStart(2, '0')}:\${String(data.getMinutes()).padStart(2, '0')}:00 WIB`;
            }");
        
        $tanggal_selesai = Column::make('tanggal_selesai')
            ->title('Tanggal Selesai')
            ->searchable(false)
            ->orderable(false)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()} 
                \${String(data.getHours()).padStart(2, '0')}:\${String(data.getMinutes()).padStart(2, '0')}:00 WIB`;
            }");
        
        return [
            // 'id',
            $tanggal_masuk,
            $tanggal_selesai,
            'ketersediaan',
            'keterangan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'jadwal_praktiks_datatable_' . time();
    }
}
