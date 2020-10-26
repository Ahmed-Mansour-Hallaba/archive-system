@if((auth()->guard('admin')->user()->level) == 0)
<a href="{{ aurl('documents/'.$document->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
@endif
