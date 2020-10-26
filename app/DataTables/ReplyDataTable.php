<?php

namespace App\DataTables;

use App\Reply;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class ReplyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('edit', 'admin.replies.btn.edit')
            ->addColumn('delete', 'admin.replies.btn.delete')
            ->rawColumns([
                'edit', 'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Reply $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reply $model, Request $request)
    {
        // if ($request->segment('3') == 'all') {
        //     return Reply::query();
        // }
        // $user_id = auth()->guard('admin')->user()->user_id;
        // $user_type = auth()->guard('admin')->user()->user_type;
        // return DB::table('replies')
        //     ->where(
        //         [
        //             "logged_user_id" => $user_id,
        //             'user_type' => $user_type,
        //             'document_id', $request->id,
        //         ]
        //     )->get();
    }

    public static function lang()
    {
        $lang = [
            "emptyTable" => trans('admin.emptyTable'),
            "info" => trans('admin.info'),
            "infoEmpty" => trans('admin.infoEmpty'),
            "infoFiltered" => trans('admin.infoFiltered'),
            "infoPostFix" => trans('admin.infoPostFix'),
            "thousands" => trans('admin.thousands'),
            "lengthMenu" => trans('admin.lengthMenu'),
            "loadingRecords" => trans('admin.loadingRecords'),
            "processing" => trans('admin.processing'),
            "search" => trans('admin.search'),
            "zeroRecords" => trans('admin.zeroRecords'),
            "paginate" => [
                "first" => trans('admin.first'),
                "last" => trans('admin.last'),
                "next" => trans('admin.next'),
                "previous" => trans('admin.previous'),
            ],
            "aria" => [
                "sortAscending" => trans('admin.sortAscending'),
                "sortDescending" => trans('admin.sortDescending'),
            ],
        ];

        return $lang;
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
        // ->addAction(['width' => '80px'])
        //->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',

                'lengthMenu' => [
                    [9, 25, 50], [9, 25, 50, 'All Data'],
                ],
                'buttons' => [
                ],

                'initComplete' => " function () {
                         this.api().columns([]).every( function () {
                         var column = this;
                         var input = document.createElement(\"input\");
                        $(input).appendTo($(column.footer()).empty())
                        .on( 'keyup', function () {
                            column.search($(this).val(),false , false, true).draw();
                        });
                    });
                }",

                'language' => self::lang(),

            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            ['name' => 'id', 'data' => 'id', 'title' => trans('admin.id')],
            ['name' => 'reply_number', 'data' => 'reply_number', 'title' => trans('admin.document_number')],
            ['name' => 'reply_subject', 'data' => 'reply_subject', 'title' => trans('admin.subject')],
            ['name' => 'reply_sender', 'data' => 'reply_sender', 'title' => trans('admin.sender')],
            ['name' => 'reply_reciever', 'data' => 'reply_reciever', 'title' => trans('admin.reciever')],
            ['name' => 'reply_date', 'data' => 'reply_date', 'title' => trans('admin.document_date')],
            ['name' => 'reply_copy_to', 'data' => 'reply_copy_to', 'title' => trans('admin.copy_to')],

            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('admin.edit'),
                'orderable' => false,
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('admin.delete'),
                'orderable' => false,
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reply_' . date('YeamdHis');
    }
}
