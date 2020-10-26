<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'إضافة قسم جديد';
        $branches = Branch::all();
        return view('admin.departments.create', compact('title', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'department_name' => 'required',
            'branch_name_select' => 'required',
        ]);
        $data['name'] = $request->input('department_name');
        $data['branch_id'] = $request->input('branch_name_select');

        $departments = Department::where([
            'name' => $request->input('department_name'),
            'branch_id' => $request->input('branch_name_select'),

        ])->get();

        if (count($departments) > 0) {
            session()->flash('exist', 'هذا القسم موجود بالفعل');
            return redirect(aurl('admin'));
        }

        Department::create($data);

        session()->flash('success_add', trans('admin.success_add'));
        return redirect(aurl('admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
