@if (auth()->guard('admin')->user()->user_type !== 0 && auth()->guard('admin')->user()->id !== 1 &&
         auth()->guard('admin')->user()->level !== 0  && auth()->guard('admin')->user()->user_id !== null)

    <div class="container">
        <div class="wrong">
            <h1>لا يمكن عرض مكاتبات هنا </h1>
            <?php
                return 'هذا المسار خاطئ';
            ?>
        </div>
    </div>


@endif
@if (auth()->guard('admin')->user()->user_type == 0 && auth()->guard('admin')->user()->id == 1 &&
         auth()->guard('admin')->user()->level == 0  && auth()->guard('admin')->user()->user_id == null)



        @extends('admin.index')
        @section('content')

            <div>
                <h2 class="text-center"><b>{{ $title }}</b></h2>
            </div>


            <div class="row">
                <div class="col-lg-3"></div>
                    {!! Form::open(["url" => aurl('master')]) !!}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>اسم الشعبه</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success col-sm-3 ' , 'style' => 'padding : 10px; float:left;']) !!}
                            </div>
                    {!! Form::close() !!}
                </div>



        @endsection

@endif
