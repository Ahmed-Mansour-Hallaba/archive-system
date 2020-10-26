
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
@php
    $word=false;
    $unitName=auth()->user()->getUnit->name;
@endphp

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
                <div class="row">
                    <div class="col-lg-6">
                        <label>رقم القيد</label>
                        <input type="text" disabled value="{{ $document->number }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>الموضوع</label>
                        <textarea disabled class="form-control">{{ $document->subject }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>الراسل</label>
                        <input type="text" disabled value="{{ $document->sender }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>المرسل إليه</label>
                        <textarea disabled class="form-control">{{ $document->reciever }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>صورة إلى </label>
                        <textarea disabled class="form-control">{{ $document->copy_to }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>تاريخ المكاتبة</label>
                        <input type="text" disabled value="{{ $document->date }}" class="form-control">
                    </div>

                </div>
                <hr>

                {{-- slider --}}
                    <div>
                        <h3 class="text-center">عرض المكاتبة</h3>
                    </div>
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
                        <div id="reportPrinting" class="carousel-inner">
                            <?php
                                $slide = 0;
                            ?>

                            @foreach ($images as $image)
                                <div class="item {{ $slide == 0 ?  'active' : '' }}">
                                    @if(substr($image,-3)=='doc' or substr($image,-4)=='docx')
                                    <img class="word-img" src="/img_background/word.png" frameborder="0" style="width:100%;min-height:640px;">
                                            <div id="word"></div>
                                        @php $word=true @endphp
                                    @else
                                        <iframe class="img" src="{{ asset('uploads/'. $image) }}" alt="image" style="width:100%;height: 800px">
                                        </iframe>
                                    @endif
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

                {{-- end slider --}}
                <br><br>
                <div class="btn-group">
                    <div class="row">
                        <div class="col-lg-4">
                            @if((auth()->guard('admin')->user()->level) == 0)
                            <a href="{{ aurl('replies/create/'.$document->id )}}"><button class="btn btn-success btn-block">إضافة رد  <i class="fa fa-plus"></i></button></a>
                            @else
                             <a href="#"><button disabled class="btn btn-success btn-block">إضافة رد  <i class="fa fa-plus"></i></button></a>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            @if(substr($images[0],-3)!='pdf' and substr($images[0],-3)!='doc' and substr($images[0],-4)!='docx')
                            <button onclick="VoucherPrint(); return false;" class="btn btn-info btn-block print"> طباعة المكاتبة  <i class="fa fa-print">
                            </i></button>
                                @endif
                            @if($word)
                                    <button onclick="downloadWord(); return false;" class="btn btn-info btn-block print"> تحميل المكاتبة  <i class="fa fa-print">
                                        </i></button>
                                @endif
                        </div>
                        <div class="col-lg-4">
                            @if(count($document->replies) >0)
                                <a href="{{ aurl('replies/' .$document->id)}}">
                                    <button class="btn btn-primary btn-block"
                                            @if($document->sender==$unitName || strpos($document->reciever,$unitName)!==false) @else disabled @endif>عرض الردود
                                        <i class="fa fa-book"></i></button></a>
                            @else
                                <button disabled title="لا يوجد ردود" class="btn btn-primary btn-block">عرض الردود  <i class="fa fa-book"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">

        function VoucherSourcetoPrint(source) {
            var jsImages = "{{ $document->image }}";
            var jsArrImages = jsImages.split("|");
            var images = "";
            for(i=0;i<jsArrImages.length;i++){
                images += "<img style='width:100%; min-height:600px;' src='{{ url('uploads').'/' }}"+jsArrImages[i]+"'>"
            }
            return "<html><head><script>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()'>\n"+ images +
                "</body></html>";
        }

            function VoucherPrint() {

                Pagelink = "about:blank";
                var pwa = window.open(Pagelink, "_new");
                pwa.document.open();
                pwa.document.write(VoucherSourcetoPrint('{{ asset('uploads/'. $images[0]) }}'));
                pwa.document.close();
            }
            function downloadWord() {
                $('.word-img').attr("src", '/img_background/dword.png');
                var word='';
                @foreach($images as $image)
                    word+="<iframe class=\"img hidden \" src=\"{{ asset('uploads/'. $image) }}\" alt=\"image\" style=\"width:100%;height: 800px\">\n" +
                    "                                        </iframe>";
                @endforeach
                $('#word').append(word);
            }

    </script>
@endsection
