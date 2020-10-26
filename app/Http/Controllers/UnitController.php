<?php

namespace App\Http\Controllers;


use App\Unit;
use Redirect,Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *u
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('admin.units.index')->with('units',Unit::all());



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), ['unitname'=>'required']);
        if ($validator->fails()) {
            $err="<div class='alert alert-danger'><h2>يجب ادخال اسم الوحده</h2></div>";
            $res=['fail',$err];
            return Response::json($res);
        }
        $validator = Validator::make($request->all(), ['unitname'=>'unique:units,name']);
        if ($validator->fails()) {
            $err="<div class='alert alert-danger'><h2>تم تسجيل اسم الوحده مسبقا</h2></div>";
            $res=['fail',$err];
        }
        else {
            $unit = new Unit();
            $unit->name = $request->unitname;
            $unit->save();
            $mes = "<div class='alert alert-success'><h2>تم تسجيل الوحده بنجاح</h2></div>";
            $res = ['suc', $mes];
        }
        return Response::json($res);
    }

    public function allunits(){
        $arr=array();
        $unitName=auth()->user()->getUnit->name;
        array_push($arr,[['name'=>$unitName]]);
        $units=DB::table('units')->distinct()->get('name');
        array_push($arr,$units);
        if(empty($arr))
            $units=['لا يوجد وحدات'];
        return ( Response::json($arr));


    }
    public function relatedunits(){
        $arr=array();
//        $units=DB::table('units')->distinct()->get('name');

//        array_push($arr,$units);
        $user = auth()->guard('admin')->user();
        if($user->user_type==0)
        {
            $branches=DB::table('branches')->where('master_id',$user->getUnit->id)->get('name');
            $departments=DB::table('departments')->whereIn('branch_id',$user->getUnit->departments)->get('name');

            array_push($arr,$branches);
            array_push($arr,$departments);
        }
        else if($user->user_type==1)
        {
            $departments=DB::table('departments')->where('branch_id',$user->getUnit->id)->get('name');
            array_push($arr,$departments);
        }
        array_push($arr,array());


        if(empty($arr))
            $units=['لا يوجد وحدات'];
        return ( Response::json($arr));


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
        $unit = Unit::where('id',$id)->delete();
        return view('admin.units.index')->with('units',Unit::all());


    }
}
