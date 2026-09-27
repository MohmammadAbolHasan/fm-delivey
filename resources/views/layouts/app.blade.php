<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif

</head>

<body>
    

@include('layouts.navbar')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar')

        <main class="col-md-10 p-4">

            @yield('content')

        </main>

    </div>

</div>

@include('layouts.footer')

</body>

</html>