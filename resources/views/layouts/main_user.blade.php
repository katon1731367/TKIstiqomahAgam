<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TK Istiqomah</title>

    {{-- css bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    {{-- custom style --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    @if ($title == 'Home')
        @include('partials.banner')
    @else
        @include('partials.nav_user')
    @endif

    @yield('container')

    {{-- Jquery --}}
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').hide();
            }, 3000);
        })
    </script>

    @stack('js')
</body>

</html>
