<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Styles -->
        <link href="{{asset('/css/main.css')}}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.min.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light rounded">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <a href="/recipes"><button type="button" class="btn btn-info">HOME</button></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <!-- <li class="nav-item active">
                    <a class="nav-link">Left Link 1</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link">Left Link 2</a>
                    </li> -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                    <a class="nav-link">Right Link 1</a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">            Dropdown on Right</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action with a lot of text inside of an item</a>
                    </div>
                    </li> -->
                    <li>
                        <a href="/recipe/create"><button type="button" class="btn btn-info" id="createRecipe">ADD RECIPE</button></a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
       
        <div class="container" style=" margin-bottom: 100px;">
        @yield('content')
        </div>
    </body>
</html>
