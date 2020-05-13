<?php

use App\Controller\UserController;

$assets = 'App/File/Home/'; ?>
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
    <link rel="shortcut icon" href="<?php echo $assets; ?>images/version/bossearn.jpeg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo $assets; ?>images/version/bossearn.jpeg">
    
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
                    <a class="navbar-brand" href="https://bossearn.com/"><img src="<?php echo $assets; ?>images/version/bossearn.jpeg" alt="" width="100" height="50"></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                            <?php if (isset($_SESSION['uname'])) {?>
                                <a class="nav-link" href="/dashboard.php">Dashboard</a>
                            <?php } ?>
                            </li>
                            <li class="nav-item">
                            <?php if (isset($_SESSION['uname']) && UserController::getUserRole($_SESSION['uname']) == 'user') {?>
                                <a class="nav-link" href="/vendors.php">Vendors</a>
                            <?php } elseif (isset($_SESSION['uname']) && UserController::getUserRole($_SESSION['uname']) == 'vendor') {?>
                                <a class="nav-link" href="/users.php">users</a>
                            <?php } ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/how.php">how it works</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact.php">Contact us</a>
                            </li>
                            <li class="nav-item">
                            <?php if (!isset($_SESSION['uname'])) {?>
                                <a class="nav-link" href="/login.php">Login</a>
                            <?php } else {?>
                                <a class="nav-link" href="/logout.php">Logout</a>
                            <?php } ?>
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
