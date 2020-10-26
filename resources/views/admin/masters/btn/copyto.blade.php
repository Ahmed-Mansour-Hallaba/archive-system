@php
    $copy_to=explode(';',$document->copy_to);
    $status=0;
    $replies=$document->replies;
    $reply_copy='; ';
    foreach($replies as $reply)
        {
            $reply_copy.=$reply->sender.' ; ';
        }

@endphp
@foreach($copy_to as $copy)
    @php
        if(strpos($reply_copy,$copy)!==false)
            $status=1;
        else
        {
            if($document->rep_date==null || $document->rep_date>now()->subtract('1 day'))
                $status=2;
            else
                $status=3;
        }
    @endphp
    <span  class="badge"
           style="background-color: @if($status==1) #4cae4c @elseif($status==2) #f39c12 @else #dd4b39 @endif"
          data-toggle="tooltip" title=" @if($status==1) تم الرد @elseif($status==2) في انتظار الرد @else لم يتم الرد@endif">
                                {{$copy}}
                                </span>
@endforeach
