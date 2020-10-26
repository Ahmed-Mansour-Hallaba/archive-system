@php
    $unitName=auth()->user()->getUnit->name;
@endphp
@if($unitName==$document->sender || strpos($document->reciever,$unitName)!==false)
    @foreach($document->replies as $reply)
        <a href="/admin/reply/display?&rep_id={{$reply->id}}">{{$reply->number}} </a>
    @endforeach
@else
    @foreach($document->replies as $reply)
        @if($reply->sender==$unitName)
            <a href="/admin/reply/display?&rep_id={{$reply->id}}">{{$reply->number}} </a>
        @endif
    @endforeach
@endif
