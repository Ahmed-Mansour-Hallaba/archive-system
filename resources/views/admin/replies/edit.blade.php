
@if (auth()->guard('admin')->user()->user_type == 0 && auth()->guard('admin')->user()->id == 1 &&
         auth()->guard('admin')->user()->level == 0  && auth()->guard('admin')->user()->user_id == null)

    <div class="container">
        <div class="wrong">
            <h1>لا يمكن عرض مكاتبات هنا </h1>
            <?php
            return 'هذا المسار خاطئ';
            ?>
        </div>
    </div>


@endif

@extends('admin.index')
@section('content')

    <?php
    $id = Request::segment(4);
    ?>

    <div>
        <h2 class="text-center"><b style="color: #854680; text-decoration:underline;">إضافة رد </b></h2>
    </div>

    <div class="box">
        <div class="box-header">
            <br><br>
        </div>

        <div class="box-body">
            {!! Form::open(['url' => aurl("replies/$reply->id") , 'files' => true]) !!}
            <input type="hidden" name="user_type" value="{{ auth()->guard('admin')->user()->user_type }}">
            <input type="hidden" name="user_id" value="{{ auth()->guard('admin')->user()->user_id }}">
            <div class="row">
                <div class="col-lg-4">
                    {!! Form::hidden('document_id', $reply->document_id) !!}
                    <div class="form-group">
                        {!! Form::label('number', 'رقم القيد ') !!}
                        {!! Form::text('number', $reply->number,['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subject', 'الموضوع') !!}
                        {!! Form::textarea('subject'," $reply->subject" ,['class' => 'form-control', 'required', 'rows'=>"2"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sender', trans('admin.sender')) !!}
                        {{--                                {!! Form::text('sender', old('sender'),['class' => 'form-control' , 'required']) !!}--}}
                        <div class="form-group">
                            <select class="form-control select2" id="sender" name="sender" data-placeholder="اختر وحده"
                                    style="width: 92%;">
                                <option value="{{$unitName}}">{{$unitName}}</option>

                            @foreach($units as $unit)
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('reciever', trans('admin.reciever')) !!}
                        {{--                                {!! Form::textarea('reciever', old('reciever'),['class' => 'form-control' , 'required', 'rows'=>"2"]) !!}--}}
                        <div class="form-group">
                            <select class="form-control select2" id="reciever" name="recievers[]" multiple="multiple" data-placeholder="اختر وحدات"
                                    style="width: 92%;">
                                <option value="{{$unitName}}">{{$unitName}}</option>

                            @foreach($units as $unit)
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('copy_to', trans('admin.copy_to')) !!}
                        {{--                                {!! Form::textarea('copy_to', old('copy_to'),['class' => 'form-control', 'rows'=>"2" ]) !!}--}}
                        <div class="form-group">
                            <select class="form-control select2" id="copyto" name="copiers[]" multiple="multiple" data-placeholder="اختر وحدات"
                                    style="width: 92%">
                                <option value="{{$unitName}}">{{$unitName}}</option>

                            @foreach($units as $unit)
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                @endforeach

                            </select>

                        </div>

                    </div>
                    <div class="form-group">
                        {!! Form::label('date', trans('admin.document_date')) !!}
                        {{--                                {!! Form::date('date', now(),['class' => 'form-control' , 'required' ]) !!}--}}
                        <div class="input-group date"  >
                            <input type="text" class="form-control datepicker"  value="{{date('d-m-yy',strtotime($reply->date))}}" name="date" id="date" data-date-format="dd-mm-yyyy">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('image', 'صورة من الرد') !!}
                        {!! Form::file('image[]',['class' => 'form-control image' ,'multiple' ]) !!}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">


                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            $i =0;
                            ?>
                            @foreach ($images as $image)
                                <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                                <?php
                                $i++;
                                ?>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php
                            $slide = 0;
                            ?>

                            @foreach ($images as $image)
                                <div class="item {{ $slide == 0 ?  'active' : '' }}">
                                    <iframe src="{{ asset('replies/'. $image) }}" alt="image"
                                            style="width:100%;height: 600px" class="img-thumbnail image_display">
                                    </iframe>
                                </div>

                                <?php
                                $slide++;
                                ?>
                            @endforeach

                        </div>
                    @if($slide>1)
                        <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        @endif
                    </div>
                    <h3 class="text-center">عرض صورة الرد على  المكاتبة</h3>
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit(trans('admin.edit'), ['class' => 'btn btn-success' ,
                'style' => 'width:400px; margin:0px 15px 15px 0px; padding: 15px; font-weight: bold;']) !!}
            </div>
            {!! Form::close() !!}
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

        let arr=[];
        @foreach(explode(';',$reply->reciever) as $r)
        arr.push('{{$r}}')
        @endforeach
        $('#reciever').val(arr).change();
        arr=[];
        @foreach(explode(';',$reply->copy_to) as $r)
        arr.push('{{$r}}')
            @endforeach
        var select = document.getElementById("copyto");
        crr=$('#copyto')[0].options;
        for(i=0;i<arr.length;i++)
        {
            t=1;
            for(j=0;j<crr.length;j++)
            {
                if(arr[i]==crr[j].value)
                {
                    t=0;
                    break;
                }
            }
            if(t==1)
                select.options[select.options.length] = new Option(arr[i],arr[i]);
        }
        $('#copyto').val(arr).change();
        $('#sender').val("{{$reply->sender}}").change()

    </script>
@endsection
