<?php

// Admin Routes

use Illuminate\Support\Facades\Config;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth:defines', 'admin');
    Route::get('login', 'AdminAuth@login');
    Route::post('login', 'AdminAuth@loged');

    Route::group(['middleware' => 'admin:admin'], function () {

        Route::resource('admin', 'AdminController');

        Route::get('profile','AdminController@profile');
        Route::post('changePassword','AdminController@changePassword');

        // route for documents
        Route::get('documents/branches', 'DocumentController@getBranches');
        Route::get('documents/exports', 'DocumentController@getExports');
        Route::get('documents/imports', 'DocumentController@getImports');
        Route::get('documents/replysoon', 'DocumentController@getReplySoon');
        Route::get('documents/replyend', 'DocumentController@getReplyEnd');
        Route::get('documents/departments', 'DocumentController@getDepartments');
        Route::get('documents/branches/departments', 'DocumentController@getBranchesDepartments');
        Route::get('documents/smart', 'DocumentController@smartCreate');
        Route::post('documents/smartstore', 'DocumentController@smartStore');
        Route::resource('documents', 'DocumentController');

        //routes for Master
        Route::resource('master', 'MasterController');

        //routes for Branch
        Route::resource('branch', 'BranchController');
        Route::get('/relatedDocument/{id}', 'DocumentController@getRelatedDocument');

        //routes for Department
        Route::resource('department', 'DepartmentController');

        // replies routes
        Route::get('replies/create/{id}', 'ReplyController@create');
        Route::get('replies/screate/{id}', 'ReplyController@screate');
        Route::post('replies', 'ReplyController@store');
        Route::post('replies/smartstore', 'ReplyController@smartstore');
        Route::get('replies/{id}', 'ReplyController@show');
        Route::get('reply/display', 'ReplyController@replySlider');
        Route::get('replies/{id}/edit', 'ReplyController@edit');
        Route::post('replies/{id}', 'ReplyController@update');
        Route::delete('replies/{id}', 'ReplyController@destroy');



        Route::get('/', function () {
            return view('admin.home');
        });

        Route::get('lang/{lang}', function ($lang) {
            session()->has('lang') ? session()->forget('lang') : '';
            $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'ar');
            return back();
        });

        Route::any('logout', 'AdminAuth@logout');

    });
});
