<p>
    @php
        $s=$document->sender.';'.$document->reciever.';'.$document->copy_to;
        $userDepartment=auth()->guard('admin')->user()->getUnit->departments;
    @endphp
    @foreach($userDepartment as $department)
        @if(strpos($s,$department->name)!==false)
            {{$department->name}}
        @endif
    @endforeach
</p>
