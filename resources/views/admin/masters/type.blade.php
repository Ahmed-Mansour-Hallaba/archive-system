<p>

    @if( auth()->guard('admin')->user()->getUnit->name ==$document->sender)
        صادر
    @elseif(strpos($document->reciever,auth()->guard('admin')->user()->getUnit->name)!==false)
        وارد
    @elseif(strpos($document->copy_to,auth()->guard('admin')->user()->getUnit->name)!==false)
        صورة الي
    @endif
</p>

