
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

    <div>
        <h2 class="text-center"><b>{{ $title }}</b></h2>
    </div>

    <div class="box">

        <div class="box-body">
                <div class="row">
                    {{--  @foreach ($replies as $reply)
                        <div class="col-lg-6">
                            <label>رقم القيد</label>
                            <input type="text" disabled value="{{ $reply->number }}" class="form-control">
                        </div>
                    @endforeach  --}}
                    <h1>hello</h1>
                </div>
        </div>
    </div>
@endsection

