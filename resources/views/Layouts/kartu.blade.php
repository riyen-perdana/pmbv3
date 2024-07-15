<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="https://id.uin-suska.ac.id/logo-uin-suska.ico">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Kartu Pendaftaran</title>
    <link rel="stylesheet" href="{{public_path('css/kartu.css')}}">

</head>
    <body>
        @yield('content')
    </body>
</html>
