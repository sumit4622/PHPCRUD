<!DOCTYPE html>

<html>

<head>

    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

</head>

<body>
    <div class="">
        <nav class="navbar navbar-expand-lg bg-primary mb-3 mt-3">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">Dashboard</span></a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>



    <div class="container">

        @yield('content')

    </div>



</body>

</html>
