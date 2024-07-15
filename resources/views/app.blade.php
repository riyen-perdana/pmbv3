<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/frontend/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('/frontend/css/icons.css')}}">
    @vite(['resources/js/app.js','resources/css/app.css'])
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
