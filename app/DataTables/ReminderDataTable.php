<?php

namespace App\DataTables;

use App\Models\Reminder;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ReminderDataTable extends DataTable
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

        $dataTable->addColumn('dokter', function($reminder){
            return $reminder->dokter->user->full_name . ' (' . $reminder->dokter->nip . ')';
        });

        $dataTable->addColumn('pasien', function($reminder){
            return $reminder->pasien->user->full_name;
        });

        $dataTable->addColumn('status', 'reminders.datatables_status');
        $dataTable->addColumn('action', 'reminders.datatables_actions');
        

        return $dataTable->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reminder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reminder $model)
    {
        return $model::with(['dokter', 'pasien']);
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
        $tanggal = Column::make('tanggal')
            ->title('Tanggal Masuk')
            ->searchable(false)
            ->orderable(false)
            ->render("function(){
                data = new Date(data);
                return `\${String(data.getDate()).padStart(2, '0')}-\${String(data.getMonth()+1).padStart(2, '0')}-\${data.getFullYear()} 
                \${String(data.getHours()).padStart(2, '0')}:\${String(data.getMinutes()).padStart(2, '0')}:00 WIB`;
            }");
        
        $dokter = Column::make('dokter');
        $pasien = Column::make('pasien');

        $status = Column::make('status')
            ->title('Status');

        return [
            $dokter,
            $pasien,
            'keterangan',
            $tanggal,
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
        return 'reminders_datatable_' . time();
    }
}
