
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
            {!! Form::open(["url" =>'admin/documents/smartstore' , 'files' => true]) !!}
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
{{--                        {!! Form::text('sender', old('sender'),['class' => 'form-control' , 'required']) !!}--}}
                        <div class="form-group">
                            <select class="form-control select2" id="sender" name="sender" data-placeholder="اختر وحده"
                                    style="width: 92%;">
                            </select>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">+</button>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('reciever', trans('admin.reciever')) !!}
{{--                        {!! Form::textarea('reciever', old('reciever'),['class' => 'form-control' , 'required', 'rows'=>"2"]) !!}--}}
                        <div class="form-group">
                            <select class="form-control select2" id="reciever" name="recievers[]" multiple="multiple" data-placeholder="اختر وحدات"
                                    style="width: 92%;">

                            </select>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">+</button>

                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('copy_to', trans('admin.copy_to')) !!}
{{--                        {!! Form::textarea('copy_to', old('copy_to'),['class' => 'form-control', 'rows'=>"2" ]) !!}--}}
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
{{--                        {!! Form::date('date', now(),['class' => 'form-control' , 'required']) !!}--}}
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
{{--                    <div class="form-group">--}}
{{--                        {!! Form::label('type', 'نوع المكاتبة') !!}--}}
{{--                        {!! Form::select('type',[0 => 'صادر' , 1 => 'وارد' ], null ,['class' => 'form-control', 'required' ])  !!}--}}
{{--                    </div>--}}
                    <input type="hidden" name="type" value="0">

                    <div class="form-group">
                        {!! Form::label('image', trans('admin.image')) !!}
                        <button type="button" class="btn btn-primary" onclick="scanToJpg();">{{ trans('admin.scan')}}</button>
                    </div>
                    <div id="hidden"></div>
                    <input type="hidden" name="count" id="count" value="0">
                </div>
                <div class="col-lg-8">
                    <div class="document_preview">
                        <img width="100%" height="600" style="border:1px solid black;"  id="image_display"  class=" image_display"  >
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
    <script src="{{asset('/scanner.js')}}" type="text/javascript"></script>
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
    <script>
        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                {
                    "output_settings": [
                        {
                            "type": "return-base64",
                            "format": "jpg"
                        }
                    ]
                }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                processScannedImage(scannedImage);
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("value", scannedImage.src);
                input.setAttribute("name", "img_"+i);


                document.getElementById('hidden').appendChild(input);
                if(i==0)
                {
                    document.getElementById('image_display').setAttribute('src',scannedImage.src);
                }

            }
            document.getElementById('count').value=scannedImages.length;
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            //document.getElementById('images').appendChild(elementImg);
        }

    </script>
    @endsection
