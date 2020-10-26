
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
        @php
            $unitName=auth()->guard('admin')->user()->getUnit->name;
        @endphp

        <div class="box-body">
            <div class="dt-buttons">
                <a class="dt-button btn btn-success btn-margin" href="/admin/documents/create" >
		<span>
			<i class="fa fa-plus"></i>
		إضافة مكاتبة جديدة</span>
                </a>
                <a class="dt-button btn btn-success btn-margin" href="/admin/documents/smart" >
		<span>
			<i class="fa fa-plus"></i>
	إضافة مكاتبة ذكية جديدة</span>
                </a>
            </div>

            <table id="branches_datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="hidden">id</th>
                    {{--                            <th>اسم الفرع</th>--}}
                    <th>رقم القيد</th>
                    <th>الموضوع</th>
                    <th>الراسل</th>
                    <th>المرسل إليه</th>
                    <th>التاريخ</th>
                    <th>اخر تاريخ للرد</th>
                    <th>صورة إلى</th>
                    <th>ملف المتابعة</th>
                    <th>نوع المكاتبه</th>
                    <th>الردود</th>
                    <th>عرض المكاتبة</th>
                    <th>اضافة رد</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($documents_ids as $documents)
                    @foreach ($documents as $document)
                        <tr>
                            <td class="hidden">{{ $document->id }}</td>
                            {{--                                            <td>{{ $document->branch->name }}</td>--}}
                            <td>{{ $document->number }}</td>
                            <td>{{ $document->subject }}</td>
                            <td>{{ $document->sender }}</td>
                            <td>{{ $document->reciever }}</td>
                            <td>{{ $document->date }}</td>
                            <td>{{ $document->rep_date }}</td>
                            <td>@include('admin.masters.btn.copyto')</td>
                            <td>{{ $document->folder }}</td>
                            <td>@include('admin.masters.type')</td>
                            <td>@include('admin.masters.btn.replies')</td>
                            <td><a href="/admin/relatedDocument/{{ $document->id}}">عرض المكاتبة</a></td>
                            <td>@include('admin.masters.btn.reply')</td>
                            <td>@include('admin.masters.btn.edit')</td>
                            <td>@include('admin.masters.btn.delete')</td>
                        </tr>
                    @endforeach
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection
