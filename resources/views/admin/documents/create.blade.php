
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
        <h2 class="text-center"><b>{{ $title }}</b></h2>
    </div>

    <div class="box">
        <div class="box-header">
            <h2 class="box-title">{{ $title }}</h2>
            <br><br>
        </div>

        <div class="box-body">
            {!! Form::open(["url" => aurl('documents') , 'files' => true]) !!}
                <input type="hidden" name="user_type" value="{{ auth()->guard('admin')->user()->user_type }}">
                <input type="hidden" name="user_id" value="{{ auth()->guard('admin')->user()->user_id }}">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                                {!! Form::label('number', trans('admin.document_number')) !!}
                                {!! Form::text('number', old('number'),['class' => 'form-control' , 'required']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('subject', trans('admin.subject')) !!}
                                {!! Form::textarea('subject', old('subject'),['class' => 'form-control' , 'required', 'rows'=>"2"]) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('sender', trans('admin.sender')) !!}
{{--                                {!! Form::text('sender', old('sender'),['class' => 'form-control' , 'required']) !!}--}}
                            <div class="form-group">
                            <select class="form-control select2" id="sender" name="sender" data-placeholder="اختر وحده"
                                    style="width: 92%;">
                            </select>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">+</button>
                            </div>
                        </div>
                        <div class="form-group">
                                {!! Form::label('reciever', trans('admin.reciever')) !!}
{{--                                {!! Form::textarea('reciever', old('reciever'),['class' => 'form-control' , 'required', 'rows'=>"2"]) !!}--}}
                            <div class="form-group">
                                <select class="form-control select2" id="reciever" name="recievers[]" multiple="multiple" data-placeholder="اختر وحدات"
                                        style="width: 92%;">

                                </select>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">+</button>

                            </div>
                        </div>
                        <div class="form-group">
                                {!! Form::label('copy_to', trans('admin.copy_to')) !!}
{{--                                {!! Form::textarea('copy_to', old('copy_to'),['class' => 'form-control', 'rows'=>"2" ]) !!}--}}
                            <div class="form-group">
                                <select class="form-control select2" id="copyto" name="copiers[]" multiple="multiple" data-placeholder="اختر وحدات"
                                style="width: 92%">

                                </select>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">+</button>

                            </div>

                        </div>
                        <div class="form-group">
                            {!! Form::label('sender', 'ملف المتابعة' )!!}
                            {{--                                {!! Form::text('sender', old('sender'),['class' => 'form-control' , 'required']) !!}--}}
                            <div class="form-group">
                                <select class="form-control select2" id="folder" name="folder" data-placeholder="اختر ملف المتابعة"
                                        style="width: 92%;">
                                    <option value="بدون">بدون</option>
                                    @foreach($folders as $folder)
                                        <option value="{{$folder->name}}"> {{$folder->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                {!! Form::label('date', trans('admin.document_date')) !!}
                            <div class="input-group date"  >
                                <input type="text" class="form-control datepicker"  value="{{now()}}" name="date" id="date" data-date-format="dd-mm-yyyy">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                {!! Form::label('date', trans('admin.document_rep_date')) !!}
                            <div class="input-group date"  >
                                <input type="text" class="form-control datepicker" name="rep_date" id="rep_date" data-date-format="dd-mm-yyyy">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                                {!! Form::label('type', 'نوع المكاتبة') !!}--}}
{{--                                {!! Form::select('type',[0 => 'صادر' , 1 => 'وارد' ], null ,['class' => 'form-control', 'required' ])  !!}--}}
{{--                        </div>--}}
                        <input type="hidden" name="type" value="0">
                        <div class="form-group">
                                {!! Form::label('image', trans('admin.image')) !!}
                                {!! Form::file('image[]',['class' => 'form-control image' ,'multiple' , 'required']) !!}
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="document_preview">
                            <iframe  class="image_display"
                            style="width:100%; height:600px;">
                            </iframe>

                        </div>
                        <h3 class="text-center">عرض صورة المكاتبة</h3>
                    </div>
                </div>
            <div class="form-group">
                    {!! Form::submit(trans('admin.submit'), ['class' => 'btn btn-success' ,
                    'style' => 'width:400px; margin:0px 15px 15px 0px; padding: 15px; font-weight: bold;']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Trigger the modal with a button -->

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اضف وحده جديده</h4>
                </div>
                <div class="modal-body">
                    <div id="modalresult"></div>
                    <form id="unitform">
                        @csrf
                        <div class="form-group">
                            {!! Form::label('unitname', 'اسم الوحده') !!}
                            <input type="text" class="form-control " name="unitname" id="unitname">
                        </div>
                        <div class="form-group">

                        </div>
                    </form>
                    <button id="btn-save" class="btn btn-success" value="create" >تسجيل</button>

                </div>

            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{url('/design/adminPanel/bower_components/bootstrap-datepicker1/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/design/adminPanel/bower_components/select2/dist/js/select2.full.js')}}"></script>
    <script>
        $('.datepicker').datepicker();


        $('.select2').select2();
    </script>
    <script>

        fillunits();
        $('body').on('click', '#btn-save', function () {
            $('#btn-save').html('جاري التسجيل');
            $.ajax({
                data: $('#unitform').serialize(),
                url: "/unitstore",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    debugger
                    $('#unitname').removeClass('bg-red')

                    var res=data[0];
                    var user=data[1];
                    $('#modalresult').html(data[1]);
                    $('#modalresult').fadeIn(10);
                    if(res=='fail')
                        $('#unitname').addClass('bg-red')

                    $('#btn-save').html('تسجيل');
                    fillunits()
                    $('#modalresult').fadeOut(5000);
                    // $('#ajax-crud-modal').modal('hide');




                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endsection
