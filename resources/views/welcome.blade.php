<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <h1>Halo</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" id="tab-1">Resvara</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-2">IAT</a>
            </li>
        </ul>
        <div id="content">

        </div>
    </div>



    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tab-1').click(function() {
                $.ajax({
                    type: "GET",
                    url: '/tab1',
                    success: function(data) {
                        $("#content").html(data);
                        $("#tab-1").addClass('active');
                        $("#tab-2").removeClass('active');
                    }
                });
            });
            $('#tab-2').click(function() {
                $.ajax({
                    type: "GET",
                    url: '/tab2',
                    success: function(data) {
                        $("#content").html(data);
                        $("#tab-2").addClass('active');
                        $("#tab-1").removeClass('active');
                    }
                });
            });
        });
    </script>

</body>

</html>
