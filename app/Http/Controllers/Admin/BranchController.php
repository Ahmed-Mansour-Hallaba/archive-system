<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Master;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BranchController extends Controller
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
        $title = 'إضافة فرع جديد';
        $masters = Master::all();
        return view('admin.branches.create', compact('title', 'masters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->input('independent_branch_name')) && $request->input('user_type') == 0) {
            $data = $this->validate(request(), [
                'independent_branch_name' => 'required',
                'master_id' => 'sometimes|nullable',
            ]);

            $data['name'] = $request->input('independent_branch_name');
            $branches = DB::table('branches')->where('name', '=', Input::get('independent_branch_name'))->get();

            if (count($branches) > 0) {
                session()->flash('exist', 'هذا الفرع موجود بالفعل');
                return redirect(aurl('admin'));
            }
            Branch::create($data);

            session()->flash('success_add', trans('admin.success_add'));
            return redirect(aurl('admin'));
        }

        if (!empty($request->input('dependent_branch_name')) && $request->input('user_type') == 1) {

            $data = $this->validate(request(), [
                'dependent_branch_name' => 'required',
                'master_name_select' => 'required',
            ]);
            $data['name'] = $request->input('dependent_branch_name');
            $data['master_id'] = $request->input('master_name_select');

            $branches = DB::table('branches')->where([
                'name' => $request->input('dependent_branch_name'),
                'master_id' => $request->input('master_name_select'),

            ])->get();

            if (count($branches) > 0) {
                session()->flash('exist', 'هذا الفرع موجود بالفعل');
                return redirect(aurl('admin'));
            }
            Branch::create($data);

            session()->flash('success_add', trans('admin.success_add'));
            return redirect(aurl('admin'));
        }

        session()->flash('exist', 'الرجاء اختيار نوع الفرع');
        return redirect()->back();

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
