<?php $assets = 'App/File/Home/'; ?>
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Bossearn</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo $assets; ?>images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo $assets; ?>images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet"> 
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $assets; ?>css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $assets; ?>style.css" rel="stylesheet">

    <!-- Animate styles for this template -->
    <link href="<?php echo $assets; ?>css/animate.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="<?php echo $assets; ?>css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="<?php echo $assets; ?>css/colors.css" rel="stylesheet">

    <!-- Version Marketing CSS for this template -->
    <link href="<?php echo $assets; ?>css/version/marketing.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    .h-i{
        width: 100%;
        height: 500px;
        margin-top: 50px;
    }
    @media (max-width: 700px){
        .h-i{
        width: 100%;
        height: 250px;
    }
    }
</style>
</head>
<body>
<div id="wrapper">
        <header class="market-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="https://bossearn.com/"><img src="<?php echo $assets; ?>images/version/bossearn.png" alt="" width="200"></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="https://bossearn.com/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://bossearn.com/dashboard.php/">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://bossearn.com/vendors.php/">Vendors</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">how it works</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login.php">Login</a>
                            </li>
                        </ul>
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->

        <div class="row">
            <div class="col-md-12" style="border: 1px solid black;">
                <img class="h-i" src="<?php echo $assets; ?>images/version/b1.jpeg" alt="bossearn">
            </div>    
        </div><!-- end page-title -->
        <marquee><h2> Welcome to Bossearn <small>we are glad to have you back today. kindly login with your registered username and password to start enjoying the opportunities for today. wishing you splendid day ahead!</small></h2></marquee>
