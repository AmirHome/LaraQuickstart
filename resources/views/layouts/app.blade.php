<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.header')
    @yield('headExtra')
</head>
<body>
    <div id="app">
        @include('partials.topbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
@include('partials.javascriptVariables')
@include('partials.javascripts')
@yield('javascriptExtra')

@include('partials.footer')
</body>
</html>