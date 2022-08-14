<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TK Istiqomah</title>

    {{-- css bootstrap --}}
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    {{-- custom style --}}
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    @yield('container')

    {{-- jquery --}}
    <script src="js/jquery-3.1.0.min.js"></script>
    {{-- bootstrap --}}
    <script src="js/bootstrap.min.js"></script>
    {{-- @stack('js') --}}

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#logout').hide();
            }, 3000);
        })
    </script>
</body>

</html>
