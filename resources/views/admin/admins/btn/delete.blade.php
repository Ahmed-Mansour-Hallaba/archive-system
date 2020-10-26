<!-- Trigger the modal with a button -->

@if((auth()->guard('admin')->user()->level) == 0)
      @if ($id != 1)
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_admin{{ $id }}">
          <i class="fa fa-trash"></i>
      </button>
      @endif
@endif




<!-- Modal -->
<div id="delete_admin{{ $id }}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      {!! Form::open(['route'=>['admin.destroy', $id], 'method' => 'delete']) !!}
        <div class="modal-body">
            <p>{{ trans('admin.delete_this')}}<span style="color: #587623"><b>{{ $name }}</b></span></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
             {!! Form::submit(trans('admin.yes'), ['class' => 'btn btn-danger']) !!}
        </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
