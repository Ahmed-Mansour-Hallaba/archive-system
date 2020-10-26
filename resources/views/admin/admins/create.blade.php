@extends('admin.index')
@section('content')

    <div>
        <h2 class="text-center"><b>{{ $title }}</b></h2>
    </div>

<div class="row">
    <div class="col-sm-1"></div>

    <div class=" col-sm-9 " style="margin-top: 10%;">
        <div>
            {!! Form::open(["url" => aurl('admin')]) !!}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            {!! Form::label('name', trans('admin.name_create')  , ['class' => 'col-sm-3 col-form-label'])  !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', old('name'),['class' => 'form-control', 'required'])   !!}
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group row">
                            {!! Form::label('email', trans('admin.email_create'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                            {!! Form::email('email', old('email'),['class' => 'form-control' , 'required'])  !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group row">
                             {!! Form::label('level', 'نوع المستخدم', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                            {!! Form::select('level',[0 => 'admin' , 1 => 'user' ], null ,['class' => 'form-control mt-4', 'required' ])  !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group row">
                            {!! Form::label('password', trans('admin.password_create'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                            {!! Form::password('password',['class' => 'form-control mt-4', 'required'])  !!}
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            {!! Form::label('user', 'المستخدم', ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">

                                <div class="row">

                                    {{--  master  --}}

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input master" type="radio" name="user_type" value="0">
                                            <label class="form-check-label" >شعبة  </label>

                                            <div class="row hidden_master hidden">
                                                <label  class="col-sm-2 col-form-label">الشعبة  </label>
                                                <div class="col-sm-10">
                                                   <select class="custom-select form-control" name="master_name_value">
                                                        @foreach ($masters as $master)
                                                            <option value={{ $master->id }}>{{ $master->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                         </div>
                                    </div>

                                    {{--   branches  --}}

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input branch" type="radio" name="user_type"  value="1">
                                            <label class="form-check-label" >فرع  </label>

                                            <div class="row hidden_branch hidden">
                                                <label  class="col-sm-2 col-form-label">الفرع  </label>
                                                <div class="col-sm-10">
                                                   <select class="custom-select form-control" name="branch_name_value">
                                                        @foreach ($branches as $branch)
                                                            <option value={{ $branch->id }}>{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                         </div>
                                    </div>

                                    {{--  departments  --}}

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input department" type="radio" name="user_type" value="2">
                                            <label class="form-check-label" >قسم  </label>

                                            <div class="row hidden_department hidden">
                                                <label  class="col-sm-2 col-form-label">القسم  </label>
                                                <div class="col-sm-10">
                                                   <select class="custom-select form-control" name="department_name_value">
                                                        @foreach ($departments as $department)
                                                            <option value={{ $department->id }}>{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                         </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <br><br><br>
                <div class="form-group row">
                    <div class="col-sm-12 " >
                        {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success col-sm-3 ' , 'style' => 'padding : 10px; float:left;']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            </div>

        </div>




@endsection
