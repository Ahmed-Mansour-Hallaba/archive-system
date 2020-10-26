<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
 Route::get('/', function () {
        return redirect('/admin');
    });

 Route::get('/units','UnitController@index');
 Route::get('/allunits','UnitController@allunits');
 Route::get('/relatedunits','UnitController@relatedunits');
 Route::post('/unitstore','UnitController@store');
 Route::get('/units/delete/{id}','UnitController@destroy');



 Route::get('/folders','FolderController@index');
 Route::get('/createFolder','FolderController@create');
 Route::post('/createFolder','FolderController@store');
 Route::get('/deleteFolder/{id}','FolderController@destroy');
 Route::get('/folderDocs/{folderName}','FolderController@show');
 Route::get('/setFolderDocs/{folderName}','FolderController@setFolder');
 Route::get('/setFolderDoc/{docId}/{folderName}','FolderController@setFolderDoc');


