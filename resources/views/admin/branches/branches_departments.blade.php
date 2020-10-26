
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
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">{{ $title }}</h2>
        </div>

        <div class="box-body">
             <table id="branches_datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>رقم القيد</th>
                            <th>الموضوع</th>
                            <th>الراسل</th>
                            <th>المرسل إليه</th>
                            <th>التاريخ</th>
                            <th>صورة إلى</th>
                        </tr>
                    </thead>
                    <tbody>

                                @foreach ($documents_ids as $documents)
                                    @foreach ($documents as $document)
                                       <tr>
                                            <td>{{ $document->number }}</td>
                                            <td>{{ $document->subject }}</td>
                                            <td>{{ $document->sender }}</td>
                                            <td>{{ $document->reciever }}</td>
                                            <td>{{ $document->date }}</td>
                                            <td>{{ $document->copy_to }}</td>
                                       </tr>
                                    @endforeach
                                @endforeach

                    </tbody>
            </table>
        </div>
    </div>

@section('js')
    <script>
         // data table for branches
         $(document).ready(function() {
              $("#branches_datatable").DataTable();
         });

    </script>
@endsection


@endsection
