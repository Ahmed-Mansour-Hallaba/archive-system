@if((auth()->guard('admin')->user()->id) == $id)
    <a href="{{ aurl('admin/'.$id.'/edit') }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
@endif