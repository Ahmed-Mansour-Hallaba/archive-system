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
    <br><br><br>

    <div class="row">
            <div class="col-lg-3"></div>
                {!! Form::open(["url" => aurl('department')]) !!}
                        <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label  class="col-sm-2 col-form-label"> القسم</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="department_name" class="form-control"  placeholder="ادخل اسم القسم"><br><br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-sm-2 col-form-label"> الفرع</label>
                                        <div class="col-sm-10">
                                            <select class="custom-select form-control" name="branch_name_select">
                                                @foreach ($branches as $branch)
                                                    <option value={{ $branch->id }}>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                        </div>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success col-lg-4 ' , 'style' => 'padding : 10px; float:left;']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    @endsection

@endif
