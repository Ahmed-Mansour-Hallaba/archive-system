<p>
    @php
        $s=$document->sender.';'.$document->reciever.';'.$document->copy_to;
        $userBranches=auth()->guard('admin')->user()->getUnit->branches;
    @endphp
    @foreach($userBranches as $branch)
        @if(strpos($s,$branch->name)!==false)
            {{$branch->name}}
        @endif
    @endforeach
</p>
