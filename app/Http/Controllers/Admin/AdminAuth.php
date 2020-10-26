<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        return view('admin.login');
    }

    public function loged()
    {
        $rememberMe = request('rememberMe') == 1 ? true : false;
        if (auth()->guard('admin')->attempt(
            [
                'password' => request('password'),
                'email' => request('email'),
            ], $rememberMe
        )) {
            return redirect('admin');
        } else {
            session()->flash('error', 'خطأ فى البريد الإلكترونى أو الرقم السرى');
            return redirect('admin/login');
        }

    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function forgot_password_post()
    {
        $admin = Admin::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::to($admin->email)->send(new AdminResetPassword([
                'data' => $admin,
                'token' => $token,
            ]));

            session()->flash('success', trans('admin.successMessage'));

        }

        return back();
    }

}
