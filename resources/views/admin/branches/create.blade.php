
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
         {!! Form::open(["url" => aurl('branch')]) !!}
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                        <div class="row">
                            <div class="form-check">
                                <div class="col-lg-6 independent_branch">
                                    <input class="form-check-input independent_branch_radio" type="radio" name="user_type" value="0">
                                    <label class="form-check-label" >فرع مستقل</label>

                                    <div class="row hidden_independent_branch hidden">
                                        <label  class="col-sm-2 col-form-label">الفرع</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="independent_branch_name" class="form-control"  placeholder="ادخل اسم الفرع"><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 dependent_branch">
                                    <input class="form-check-input dependent_branch_radio" type="radio" name="user_type" value="1">
                                    <label class="form-check-label" >فرع تابع</label>

                                    <div class="row hidden hidden_branch">
                                        <label  class="col-sm-2 col-form-label"> الفرع</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="dependent_branch_name" class="form-control"  placeholder="ادخل اسم الفرع">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row hidden hidden_branch">
                                        <label  class="col-sm-2 col-form-label"> الشعبة</label>
                                        <div class="col-sm-10">
                                            <select class="custom-select form-control" name="master_name_select">
                                                @foreach ($masters as $master)
                                                    <option value={{ $master->id }}>{{ $master->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><br><br>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                        {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success col-lg-4' , 'style' => 'padding : 10px; float:left;']) !!}
                        {!! Form::close() !!}
                </div>
            </div>

        @endsection
@endif
