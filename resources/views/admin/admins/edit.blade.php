@extends('admin.index')
@section('content')

    <div>
        <h2 class="text-center"><b>{{ $title }}</b></h2>
    </div>

    <div class="box">
        <div class="box-header">
            <h2 class="box-title">{{ $title }}</h2>
        </div>

        <div class="box-body">
            {!! Form::open(["url" => aurl('admin/'.$admin->id), 'method' => 'put']) !!}
                <div class="form-group">
                        {!! Form::label('name', trans('admin.name_create')) !!}
                        {!! Form::text('name', $admin->name,['class' => 'form-control' , 'required']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('email', trans('admin.email_create')) !!}
                        {!! Form::email('email', $admin->email,['class' => 'form-control' , 'required']) !!}
                </div>

                @if((auth()->guard('admin')->user()->level) == 0)
                    <div class="form-group">
                            {!! Form::label('level', 'نوع المستخدم') !!}
                            {!! Form::select('level',[0 => 'admin' , 1 => 'user' ], null ,['class' => 'form-control mt-4', 'required' ])  !!}
                    </div>
                @endif
                <div class="form-group">
                        {!! Form::label('password', trans('admin.password_create')) !!}
                        {!! Form::password('password',['class' => 'form-control mt-4' , 'required']) !!}
                </div>
            {!! Form::submit(trans('admin.edit'), ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>



@endsection
