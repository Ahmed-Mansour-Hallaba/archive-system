@extends('admin.index')
@section('content')

    @php
        $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
        $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $arabic_alpha=explode(' ',' أ ب ج د ه و ز ح ط ي ك ل م ن س ع ف ص ق ر ش ت ث خ ذ ض ظ غ');

    @endphp
    <div>
        <h2 class="text-center"><b>الملف الشخصي </b></h2>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>

        <div class=" col-sm-9 " style="margin-top: 10%;">
            <div class="box">
                <div class="box-header">
                    <h2 class="">بيانات الشخصية بالمستخدم </h2>
                    <br><br>
                </div>
                <div class="box-body">
                    <?php $user=Auth()->user()?>
                    <div class="row">
                            <div class="col-md-6 ">
                                <label>الاسم:</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>البريد الاليكتروني</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>نوع الوحدة</label>
                            </div>
                            <div class="col-md-6">
                                <?php $types=['شعبة','فرع',"قسم"];?>
                                <p>{{$types[$user->user_type]}}</p>
                            </div>
                        </div>
                        @if($user->user_type==0 )
                            <hr>

                            <div class="row">

                                    <div class="col-md-6">
                                        <label>الافرع الخاصة بالشعبة</label>
                                    </div>
                                    <div class="col-md-6">
                                        @forelse($unit->branches as $branch)
                                            @php
                                                $str = str_replace($western_arabic, $eastern_arabic,strval($loop->iteration));
                                            @endphp
                                            <p>{{$str}}-{{$branch->name}}</p>
                                            @foreach($branch->departments as $department)
                                                @php
                                                    $str=$arabic_alpha[$loop->iteration];
                                                @endphp
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$str}}-{{$department->name}}</p>
                                            @endforeach
                                        @empty
                                            <p>لا يوجد افرع</p>
                                        @endforelse
                                    </div>

                        </div>
                        @endif
                        @if($user->user_type==1  )
                            <hr>

                        <div class="row">
                                    <div class="col-md-6">
                                        <label>الاقسام</label>
                                    </div>
                                    <div class="col-md-6">
                                        @forelse($unit->departments as $department)
                                        <p>{{$department->name}}</p>
                                        @empty
                                                <p>لا يوجد اقسام</p>
                                        @endforelse
                                    </div>

                            </div>

                        @endif

                <hr>

                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            تغيير كلمة المرور
                        </a>

                        <div class="">
                            <div class="collapse" id="collapseExample">
                                <form action="/admin/changePassword" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        {!! Form::label('oldPass', 'كلمة المرور القديمة'  , ['class' => 'col-md-3 col-form-label'])  !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('oldPass','',['class' => 'form-control col-md-6', 'required'])   !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('newPass', 'كلمة المرور الجديدة'  , ['class' => 'col-sm-3 col-form-label'])  !!}
                                        <div class="col-sm-9">
                                            <input type="password" name="newPass" id="newPass" class="form-control col-sm-6" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('conPass', 'تاكيد كلمة المرور'  , ['class' => 'col-sm-3 col-form-label'])  !!}
                                        <div class="col-sm-9">
                                            <input type="password" name="conPass" id="conPass" class="form-control col-sm-6" required>

                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        {!! Form::label(' ', ' '  , ['class' => 'col-sm-3 col-form-label'])  !!}
                                        <div class="col-sm-9">

                                        {!! Form::submit('حفظ', ['class' => 'btn btn-success col-sm-3' , 'style' => '']) !!}
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>

@endsection
