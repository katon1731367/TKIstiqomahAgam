<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boostrap 5</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
</head>
<body>
   <div class="container">
       @include('partials.navbar_user')
       @include('partials.nav_user')
           
       <div class="container mt-4">
         @yield('container')
       </div>
      
      </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>