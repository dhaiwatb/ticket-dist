<?php

use App\Models\TicketDist;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'ticketdatatable.action');
    }
    public function query(TicketDist $model)
    {
        return $model->newQuery();
    }
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }
    protected function getColumns()
    {
        return [
            'ticket_title',
            'ticket_number',
            
        ];
    }
    // protected function filename()
    // {
    //     //return 'ticket_' . date('YmdHis');
    // }
}
