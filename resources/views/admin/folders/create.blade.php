
@if (auth()->guard('admin')->user()->user_type == 0 && auth()->guard('admin')->user()->id == 1 &&
         auth()->guard('admin')->user()->level == 0  && auth()->guard('admin')->user()->user_id == null)

    <div class="container">
        <div class="wrong">
            <h1>لا يمكن عرض مكاتبات هنا </h1>
            <?php
            return 'هذا مسار خاطئ';
            ?>
        </div>
    </div>


@endif

@extends('admin.index')
@section('content')

    <div>
        <h2 class="text-center"><b>اضافة ملف متابعة جديد</b></h2>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="">اضافة ملف متابعة جديد</h3>
            <hr>
        </div>

        <div class="box-body">
            {!! Form::open(["url" => '/createFolder' , 'files' => true]) !!}
            <input type="hidden" name="user_type" value="{{ auth()->guard('admin')->user()->user_type }}">
            <input type="hidden" name="logged_user_id" value="{{ auth()->guard('admin')->user()->user_id }}">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('name', 'اسم الملف') !!}
                        {!! Form::text('name', old('nane'),['class' => 'form-control' , 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success' ,
                'style' => 'width:400px; margin:0px 15px 15px 0px; padding: 15px; font-weight: bold;']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
