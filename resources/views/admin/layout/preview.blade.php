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
                        <input type="text" disabled value="{{ $reply->reply_number }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>الموضوع</label>
                        <input type="text" disabled value="{{ $reply->reply_subject }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>الراسل</label>
                        <input type="text" disabled value="{{ $reply->reply_sender }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>المرسل إليه</label>
                        <input type="text" disabled value="{{ $reply->reply_reciever }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>صورة إلى </label>
                        <input type="text" disabled value="{{ $reply->reply_copy_to }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label>تاريخ الرد</label>
                        <input type="text" disabled value="{{ $reply->reply_date }}" class="form-control">
                    </div>
                </div>
                <hr>

                {{-- slider --}}
                    <div>
                        <h3 class="text-center">عرض صورة الرد</h3>
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
                        <div class="carousel-inner">
                            <?php
                                $slide = 0;
                            ?>

                            @foreach ($images as $image)
                                <div class="item {{ $slide == 0 ?  'active' : '' }}">
                                    <img src="{{ asset('replies/'. $image) }}" alt="image" style="width:100%;">
                                </div>

                                <?php
                                    $slide++;
                                ?>
                            @endforeach

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>


                    </div>

                {{-- end slider --}}
        </div>
    </div>
@endsection
