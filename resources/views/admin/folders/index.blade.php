
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
            <h2 class="box-title">ملفات المتابعة</h2>
        </div>
        @php
            $unitName=auth()->guard('admin')->user()->getUnit->name;
        @endphp
        <div class="box-body">
            <table id="branches_datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>اسم المتابعة</th>
                    <th>عرض  المكاتبات المتابعة</th>
                    <th>  اضافة مكاتبات للمتابعة</th>
                    <th>حذف المتابعة</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>بدون</td>
                    <td><a href="/folderDocs/بدون">عرض المكاتبات</a></td>
                    <td><a href="/setFolderDocs/بدون">اضافة مكاتبات للمتابعة</a></td>
                    <td></td>

                </tr>

                    @foreach ($folders as $folder)
                        <tr>
                           <td>{{$folder->name}}</td>
                            <td><a href="/folderDocs/{{ $folder->name}}">عرض المكاتبات</a></td>
                            <td><a href="/setFolderDocs/{{ $folder->name}}">اضافة مكاتبات للمتابعة</a></td>
                            <td>@include('admin.folders.btn.delete')</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

@section('js')
    <script>


    </script>
@endsection


@endsection
