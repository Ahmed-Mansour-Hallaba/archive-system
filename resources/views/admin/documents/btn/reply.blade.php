@if((auth()->guard('admin')->user()->level) == 0)
<a href="{{ aurl('replies/create/' .$id )}}"> إضافة رد </a>
@endif
