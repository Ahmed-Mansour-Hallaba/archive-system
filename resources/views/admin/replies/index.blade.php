
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
        <h2 class="box-title">الرد على  المكاتبات</h2>
    </div>
    <div class="box-body">
        {!! Form::open(['id="form_data"' , 'method' => 'delete']) !!}
            {!! $dataTable->table([
                'class' => 'dataTable table table-hover table-striped table-bordered'
            ],true) !!}
        {!! Form::close() !!}
    </div>
</div>

{{--  modal  --}}
<div id="modal_delete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete_title') }}</h4>
      </div>
      <div class="modal-body">
        <div>
            <div class="empty hidden">
                <h4>{{ trans('admin.please_check_some') }}</h4>
            </div>
            <div class="not_empty hidden">
                <h4>{{ trans('admin.ask_delete_all') }} &nbsp;<span class="item_count"></span> ? </h4>
            </div>
        </div>
      </div>
      <div class="modal-footer">
            <div>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
            </div>
      </div>
    </div>

  </div>
</div>
{{--  end modal  --}}
@push('js')
{!! $dataTable->scripts() !!}

@endpush

@endsection
