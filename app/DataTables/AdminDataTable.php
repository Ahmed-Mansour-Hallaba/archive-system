<?php

namespace App\DataTables;

use App\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
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
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns([
                'edit', 'delete',
            ]);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return Admin::query();
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
            ->parameters([
                'dom' => 'Blfrtip',
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i>' . trans('admin.addnew'),
                        'className' => 'btn btn-success btn-margin btn_add_document',
                        "action" => "function() {
                                window.location.href = '" . \URL::current() . "/create'
                            }"],
                    [
                        'text' => '<i class="fa fa-plus"></i>' . 'أضف شعبة',
                        'className' => 'btn btn-info btn-margin ',
                        "action" => "function() {
                                window.location.href = '" . 'master' . "/create'
                            }",

                    ],

                    [
                        'text' => '<i class="fa fa-plus"></i>' . 'أضف فرع',

                        'className' => 'btn btn-warning btn-margin ',

                        "action" => "function() {
                                window.location.href = '" . 'branch' . "/create'
                            }",
                    ],

                    [
                        'text' => '<i class="fa fa-plus"></i>' . 'أضف قسم',
                        'className' => 'btn btn-danger btn-margin ',
                        "action" => "function() {
                                window.location.href = '" . 'department' . "/create'
                            }",

                    ],

                ],
                'lengthMenu' => [
                    [5, 10, 25, 50], [5, 10, 25, 50, 'All Data'],
                ], // for search form

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
            ['name' => 'name', 'data' => 'name', 'title' => trans('admin.name')],
            ['name' => 'email', 'data' => 'email', 'title' => trans('admin.email')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('admin.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('admin.updated_at')],

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
        return 'Admin_' . date('YmdHis');
    }
}
