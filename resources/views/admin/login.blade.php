<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Đăng nhập</h2>
@if(session()->has('login_error'))
    {{ session()->get('login_error') }}
@endif
<form action="{{ route('auth.login') }}" method="post">
    @csrf
    Email:
    <input type="text" name="email">
    Password:
    <input type="text" name="password">
    <button type="submit">Login</button>
</form>

</body>
</html>
