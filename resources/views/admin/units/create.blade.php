<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>units</title>
</head>
<body>
@if (session()->has('a7a'))
    {{session('a7a')}}
    @endif
<form action="/unit" method="post">
    @csrf
    <input type="text" name="name" id="name">
    <input type="submit" value="store">
</form>
</body>
</html>
