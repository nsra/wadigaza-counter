<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>بلدية وادي غزة - تطبيق قراءة العداد</title>
    <link rel="stylesheet" href='{{ asset('./css/bootstrap-rtl.min.css') }}' />
    <link rel="stylesheet" href='{{ asset('./css/style.css') }}' />
    <link rel="stylesheet" href='{{ asset('./css/all.min.css') }}' />
    <link rel="stylesheet" href='{{ asset('./js/all.min.js') }}' />
    <link rel="stylesheet" href='{{ asset('./js/bootstrap-rtl.min.js') }}' />

</head>

<body class="antialiased" dir="rtl">
    <div class="main container-fluid">
        @yield('content')
    </div>
</body>

</html>
