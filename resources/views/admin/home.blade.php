
<!DOCTYPE html>
<html>
<head>
  <style>
    .head
    {
      color:rgba(255,255,255,.5);
      text-align: center;
    }
    h1{
        margin-top: 18%;
        font-size: 90px;
        color: #d0bf43;
    }

  </style>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body  class="parent">
   <br>
    <div class="head">
        <h1>مرحباً بكم في منظومة الأرشيف الإلكتروني</h1>
		
        @if (auth()->guard('admin')->user()->user_type == 0 && auth()->guard('admin')->user()->id == 1 &&
         auth()->guard('admin')->user()->level == 0  && auth()->guard('admin')->user()->user_id == null)
            <a href="admin/admin" class="start"><button  class="btn_archive">الأرشيف الإلكتروني</button></a>
         @endif

         @if (auth()->guard('admin')->user()->user_type !== 0 && auth()->guard('admin')->user()->id !== 1 &&
         auth()->guard('admin')->user()->level !== 0  && auth()->guard('admin')->user()->user_id !== null)
            <a href="admin/documents" class="start"><button  class="btn_archive">الأرشيف الإلكتروني</button></a>
         @endif
    </div>
</body>
</html>
