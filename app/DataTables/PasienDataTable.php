<?php

namespace App\DataTables;

use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class PasienDataTable extends DataTable
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
        
        if(Auth::user()->getRoleNames()[0] != 'klien'){
            $dataTable->addColumn('user', function(Pasien $pasien){
                return $pasien->user->full_name;
            });
        }

        $dataTable->addColumn('action', 'pasien.datatables_actions');
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pasien $model)
    {   
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        if($role == 'klien'){
            return $model::with('user')->where('user_id', $user->id)->where('status', true);
        }
        return $model::with('user')->where('status', true);
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
        $tanggal_lahir = Column::make('tanggal_lahir')
            ->title('Tanggal Lahir')
            ->searchable(false)
            ->orderable(false)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()}`;
            }");
    
        $jenis_kelamin = Column::make('jenis_kelamin')
            ->title('Jenis Kelamin')
            ->searchable(false)
            ->orderable(false);

        $ras = Column::make('ras')
            ->title('Ras')
            ->searchable(false)
            ->orderable(false);
        
        $result = [
            // 'id',
            'nama_hewan',
            'jenis_hewan',
            $jenis_kelamin,
            $ras,
            $tanggal_lahir,
        ];

        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        
        if($role != 'klien'){
            $user = Column::make('user')
            ->title('Pemilik')
            ->searchable(false)
            ->orderable(false);
            array_splice($result, 1, 0, $user);
        }

        return $result;
        
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'pasien_datatable_' . time();
    }
}
