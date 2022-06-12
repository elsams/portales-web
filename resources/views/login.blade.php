<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")   

<!------ Include the above in your HEAD tag ---------->


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Portales Web / Herramientas Empresariales</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Portales Web / Herramientas Empresariales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Ingresar</a>
                </li>              
            </ul>
        </div>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                      
                            <div class="form-group row">
                                <label for="inpUsername" class="col-md-4 col-form-label text-md-right">E-Mail Usuario </label>
                                <div class="col-md-6">
                                    <input type="text" id="inpUsername" class="form-control"  name="email-address" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="InpPassword" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="InpPassword" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id='btnLogIn' class="btn btn-primary">
                                    Ingresar
                                </button>
                                <a href="#" class="btn btn-link">
                                    Olvidaste tu contraseña?
                                </a>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>

</main>







</body>
</html>
