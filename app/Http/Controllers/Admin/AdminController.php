<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Branch;
use App\DataTables\AdminDataTable;
use App\Department;
use App\Http\Controllers\Controller;
use App\Master;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $admin)
    {
        return $admin->render('admin.admins.index', ['title' => trans('admin.admin_account')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::all();
        $branches = Branch::all();
        $departments = Department::all();
        $title = 'إضافة مسئول جديد';
        return view('admin.admins.create', compact('title', 'masters', 'branches', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'email' => 'required|unique:admins',
                'level' => 'required',
                'user_type' => 'required',
                'password' => 'required|min:6',
                'user_type' => 'required',
            ]
        );

        if (!empty($request->input('master_name_value')) && $request->input('user_type') == 0) {
            $data['user_id'] = $request->input('master_name_value');
        }

        if (!empty($request->input('branch_name_value')) && $request->input('user_type') == 1) {
            $data['user_id'] = $request->input('branch_name_value');
        }

        if (!empty($request->input('department_name_value')) && $request->input('user_type') == 2) {
            $data['user_id'] = $request->input('department_name_value');
        }

        $data['password'] = bcrypt(request('password'));

        Admin::create($data);

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
        $admin = Admin::find($id);
        $title = trans('admin.edit');
        return view('admin.admins.edit', compact('admin', 'title'));
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

        $data = $this->validate(request(),
            [
                'name' => 'required',
                'email' => 'required|unique:admins,email,' . $id,
                'password' => 'sometimes|nullable|min:6',
            ]
        );
        if (request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }

        Admin::where('id', $id)->update($data);
        session()->flash('success_add', trans('admin.success_update'));
        return redirect(aurl('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            session()->flash('bad_choice', trans('admin.bad_choice'));
            return redirect(aurl('admin'));
        } else {
            Admin::find($id)->delete();
            session()->flash('success_add', trans('admin.success_delete'));
            return redirect(aurl('admin'));
        }
        Admin::find($id)->delete();
        session()->flash('success_add', trans('admin.success_delete'));
        return redirect(aurl('admin'));
    }
    public function profile(){

        $user=Auth::user();

        if($user->user_type==0)
            $unit=Master::find($user->user_id);
        else if($user->user_type==1)
            $unit=Branch::find($user->user_id);
        else if($user->user_type==2)
            $unit=Department::find($user->user_id);

        return view('admin.profile')->with('unit',$unit);
    }
    public function changePassword(Request $request){
        $data = $this->validate(request(),
            [
                'oldPass' => 'required',
                'newPass' => 'required|min:6',
                'conPass' => 'required|same:newPass'
            ],
            [
                'oldPass.required'=>'كلمة المرور القديمة مطلوبة',
                'newPass.required'=>'كلمة المرور جديدة مطلوبة',
                'newPass.min'=>'كلمة المرور يجب ان تتكون من 6 احرف علي الأقل',
                'conPass.required'=>'تاكيد كلمة المرور  مطلوب',
                'conPass.same' => 'تاكد من ان كلمة المرور تشبة تاكيد كلمة المرور',

            ]
        );
        $user=Auth::user();
        if (Hash::check($request->oldPass,$user->password))
        {
            $user->password=bcrypt($request->newPass);
            $user->save();
            session()->flash('success_add',"تم تحديث كلمة المرور بنجاح");


        }
        else
        {
            session()->flash('exist', 'كلمة المرور القديمة غير صحيحة');

        }
       return redirect('admin/profile');
    }
}
