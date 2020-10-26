<p>
    @if( auth()->guard('admin')->user()->getUnit->name ==$sender)
صادر
@elseif(strpos(auth()->guard('admin')->user()->getUnit->name,$reciever)!==false)
وارد
@elseif(strpos(auth()->guard('admin')->user()->getUnit->name,$copy_to)!==false)
صورة الي
    @endif
</p>
