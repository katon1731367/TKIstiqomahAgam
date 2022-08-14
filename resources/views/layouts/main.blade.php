<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TK Istiqomah Agam</title>

    {{-- dashboard template css --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    {{-- css bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    {{-- DataTables style --}}
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}" />
    {{-- custom style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">

    <style>
      trix-toolbar [data-trix-button-group="file-tools"] {
         display: none;
      }
    </style>
</head>

<body>

    @include('partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div>

    {{-- Jquery --}}
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- Chart JS --}}
    <script src="{{ asset('js/chart.min.js') }}"></script>
    {{-- dataTables --}}
    <script src="{{ asset('js/dataTables.js') }}"></script>
    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>

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
