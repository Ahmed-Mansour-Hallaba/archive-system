
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
            {!! Form::open(['url' => aurl('replies/smartstore') , 'files' => true]) !!}
                <input type="hidden" name="user_type" value="{{ auth()->guard('admin')->user()->user_type }}">
                <input type="hidden" name="user_id" value="{{ auth()->guard('admin')->user()->user_id }}">
                <div class="row">
                    <div class="col-lg-4">
                                  {!! Form::hidden('document_id', $id) !!}
                        <div class="form-group">
                                {!! Form::label('number', 'رقم القيد ') !!}
                                {!! Form::text('number', old('number'),['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('subject', 'الموضوع') !!}
                                {!! Form::textarea('subject'," $document->subject" ,['class' => 'form-control', 'required', 'rows'=>"2"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sender', trans('admin.sender')) !!}
                            {{--                                {!! Form::text('sender', old('sender'),['class' => 'form-control' , 'required']) !!}--}}
                            <div class="form-group">
                                <select class="form-control select2" id="sender" name="sender" data-placeholder="اختر وحده"
                                        style="width: 92%;">
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
                                    @foreach($unitsarr as $units)

                                    @foreach($units as $unit)
                                        <option value="{{$unit->name}}">{{$unit->name}}</option>
                                    @endforeach
                                    @endforeach


                                </select>

                            </div>

                        </div>
                        <div class="form-group">
                                {!! Form::label('date', 'تاريخ الرد') !!}
{{--                                {!! Form::date('date', old('date'),['class' => 'form-control', 'required']) !!}--}}
                            <div class="input-group date"  >
                                <input type="text" class="form-control datepicker" name="date" value="{{now()}}" id="date" data-date-format="dd-mm-yyyy">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                {!! Form::label('image', 'صورة من الرد') !!}
                            <button type="button" class="btn btn-primary" onclick="scanToJpg();">{{ trans('admin.scan')}}</button>
                        </div>
                        <div id="hidden"></div>
                        <input type="hidden" name="count" id="count" value="0">
                    </div>
                    <div class="col-lg-8">
                        <div class="document_preview">
                            <div class="document_preview">
                                <img width="100%" height="600" style="border:1px solid black;"  id="image_display"  class=" image_display"  >
                            </div>
                        </div>
                        <h3 class="text-center">عرض صورة الرد على  المكاتبة</h3>
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

@section('script')
    <script src="{{url('/design/adminPanel/bower_components/bootstrap-datepicker1/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('/design/adminPanel/bower_components/select2/dist/js/select2.full.js')}}"></script>

    <script>
        $('.datepicker').datepicker()
        $('.select2').select2();

    </script>
    <script src="{{asset('/scanner.js')}}" type="text/javascript"></script>

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
    <script>

        let arr=[];
        @foreach(explode(';',$document->reciever) as $r)
        arr.push('{{$r}}')
        @endforeach
        $('#reciever').val(arr).change();
        arr=[];
        @foreach(explode(';',$document->copy_to) as $r)
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
        $('#sender').val("{{$document->sender}}").change()

    </script>
@endsection
