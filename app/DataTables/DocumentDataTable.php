<?php

namespace App\DataTables;

use App\Branch;
use App\Department;
use App\Document;
use App\Master;
use App\Reply;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class DocumentDataTable extends DataTable
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
            ->addColumn('type', 'admin.documents.btn.type')
            ->addColumn('replies', 'admin.documents.btn.replies')
            ->addColumn('link', 'admin.documents.btn.link')
            ->addColumn('reply', 'admin.documents.btn.reply')
            ->addColumn('edit', 'admin.documents.btn.edit')
            ->addColumn('delete', 'admin.documents.btn.delete')
            ->rawColumns([
                'type', 'link', 'edit', 'delete','replies',
                'reply',

            ])

            ;

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Document $model
     * @param \App\Reply $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Document $model, Request $request)
    {

        // $user_id = auth()->guard('admin')->user()->user_id;
        // $user_type = auth()->guard('admin')->user()->user_type;
        // $name = auth()->guard('admin')->user()->name;
        // $unit=auth()->guard('admin')->user()->getUnit;
        // $master = Master::where('name', $name)->get();
        // $related_branches_arr = array('No branches');
        // $related_branch_depatments_arr = array('No Departments related to branch');
        // $related_master_branch_depatments_arr = array('No Departments related to master branch');

        // if (count($master) == 0) {} else {
        //     $related_branches_arr = array();
        //     $related_branch_depatments_arr = array();
        //     $related_master_branch_depatments_arr = array();

        //     $related_branches = Branch::Where('master_id', $master[0]->id)->get();

        //     foreach ($related_branches as $related_branch) {
        //         array_push($related_branches_arr, $related_branch->name);

        //         $depts = Department::where('branch_id', $related_branch->id)->get();
        //         foreach ($depts as $dept) {
        //             array_push($related_master_branch_depatments_arr, $dept->name);
        //         }
        //     }

        //     // getting the department documents that related to the logged branch

        // }
        // $branch = Branch::where('name', $name)->get();
        // if (count($branch) > 0) {
        //     $branch_depts = Department::where('branch_id', $branch[0]->id)->get();
        //     foreach ($branch_depts as $branch_dept) {

        //         array_push($related_branch_depatments_arr, $branch_dept->name);
        //     }
        // }

        // return Document::where(
        //     [
        //         "logged_user_id" => $user_id,
        //         'user_type' => $user_type,
        //     ]
        // )
        //     ->orWhere('sender', 'LIKE', "%{$name}%")
        //     ->orWhereIn('sender', $related_branches_arr)
        //     ->orWhereIn('sender', $related_branch_depatments_arr)
        //     ->orWhereIn('sender', $related_master_branch_depatments_arr)
        //     ->orWhere('reciever', 'LIKE', "%{$name}%")
        //     ->orWhereIn('reciever', $related_branches_arr)
        //     ->orWhereIn('reciever', $related_branch_depatments_arr)
        //     ->orWhereIn('reciever', $related_master_branch_depatments_arr)
        //     ->orWhere('copy_to', 'LIKE', "%{$name}%")
        //     ->orWhereIn('copy_to', $related_branches_arr)
        //     ->orWhereIn('copy_to', $related_branch_depatments_arr)
        //     ->orWhereIn('copy_to', $related_master_branch_depatments_arr)

        //     ->get();

        $user_id = auth()->guard('admin')->user()->user_id;
        $user_type = auth()->guard('admin')->user()->user_type;
        $name = auth()->guard('admin')->user()->getUnit->name;
        return Document::where(
            [
                "logged_user_id" => $user_id,
                'user_type' => $user_type,
            ])
             ->orWhere('sender', 'LIKE', "%{$name}%")
             ->orWhere('reciever', 'LIKE', "%{$name}%")
             ->orWhere('copy_to', 'LIKE', "%{$name}%")
             ->get();


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

                'lengthMenu' => [
                    [10, 25, 50], [9, 25, 50, 'All Data'],
                ],
                'buttons' => [
                    ['text' => '<i class="fa fa-plus"></i>' . 'إضافة مكاتبة جديدة', 'className' => 'btn btn-success btn-margin',
                        "action" => "function() {
                            window.location.href = '" . \URL::current() . "/create'
                        }",
                    ],
                    [  'text' => '<i class="fa fa-plus"></i>' . 'إضافة مكاتبة ذكية جديدة', 'className' => 'btn btn-success btn-margin',
                        "action" => "function() {
                            window.location.href = '" . \URL::current() . "/smart'
                        }",],
                    ['extend' => 'reload', 'className' => 'btn-margin btn btn-default', 'text' => '<i class="fa fa-refresh"></i>'],
                ], // for search form


                'language' => self::lang(),

                "order"=> [[ 0, "desc" ]],

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

            ['name' => 'id', 'data' => 'id','class'=>'hidden', 'title' => trans('admin.id')],
            ['name' => 'number', 'data' => 'number', 'title' => trans('admin.document_number')],
            ['name' => 'subject', 'data' => 'subject', 'title' => trans('admin.subject')],
            ['name' => 'sender', 'data' => 'sender', 'title' => trans('admin.sender')],
            ['name' => 'reciever', 'data' => 'reciever', 'title' => trans('admin.reciever')],
            ['name' => 'date', 'data' => 'date', 'title' => trans('admin.document_date')],
            ['name' => 'copy_to', 'data' => 'copy_to', 'title' => trans('admin.copy_to')],
            ['name' => 'folder', 'data' => 'folder', 'title' => trans('admin.folder')],

            [
                'name' => 'type',
                'data' => 'type',
                'title' => 'نوع المكاتبة',
                'orderable' => false,
                'printable' => false,
                'exportable' => false,
            ],
            [
                'name' => 'replies',
                'data' => 'replies',
                'title' => 'ردود المكاتبة',
                'orderable' => false,
                'printable' => false,
                'exportable' => false,
            ],
            [
                'name' => 'link',
                'data' => 'link',
                'title' => 'عرض',
                'orderable' => false,
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ],
            [
                'name' => 'reply',
                'data' => 'reply',
                'title' => 'إضافه رد',
                'orderable' => false,
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ],
            // [
            //     'name' => 'show_reply',
            //     'data' => 'show_reply',
            //     'title' => 'عرض الرد',
            //     'orderable' => false,
            //     'searchable' => false,
            //     'printable' => false,
            //     'exportable' => false,
            // ],

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
        return 'Document_' . date('YeamdHis');
    }
}
