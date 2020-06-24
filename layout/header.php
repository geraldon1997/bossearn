<?php

use App\Controllers\CouponController;
use App\Models\Role;
use App\Models\User;

require_once 'autoload.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="shortcut icon" href="App/Assets/Images/logo.jpeg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="App/Assets/Images/logo.jpeg">

    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="App/Assets/Css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="App/Assets/Css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="App/Assets/Css/style.css" rel="stylesheet">

    <!-- Animate styles for this template -->
    <link href="App/Assets/Css/animate.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="App/Assets/Css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="App/Assets/Css/colors.css" rel="stylesheet">

    <!-- Version Marketing CSS for this template -->
    <link href="App/Assets/Css/version/marketing.css" rel="stylesheet">


    <link rel='stylesheet' href='App/Assets/Css/share-button.min.css' type='text/css' media='all'/>
    <!-- <script src="App/Assets/Js/jquery.min.js"></script> -->
    


<style>
    #logo{
        width: 100px;
        height: 70px;
    }
    share-button{
        background-color: gold;
        color: black;
        padding-left: 50px;
        padding-right: 50px;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    #logout:hover{
        cursor: pointer;
    }
    .page-wrapper{
        margin-top: 50px;
        margin-bottom: 100px;
        text-align: center;
    }
    .tbl{
        overflow: auto;
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
                    <a class="navbar-brand" href="/"><img src="App/Assets/Images/version/logo.jpeg" alt="bossearn" id="logo"></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">




                            <?php if (isset($_SESSION['uname'])) {?>

                          	<li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="how.php">how it works</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">contact us</a>
                            </li>
                            <?php if (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'user') {?>

                            <?php if (CouponController::userCouponStatus($_SESSION['uname']) > 0) {?>

                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">dashboard</a>
                            </li>

                            <?php if ($_SESSION['uname'] === 'tonyinye') {?>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="post.php">Post</a>
                            </li>

                            <?php } ?>

                            <?php } ?>

                            <?php } elseif (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'vendor') {?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">dashboard</a>
                            </li>
                            
                            <?php } elseif (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'admin') {?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="coupons.php">coupons</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="users.php">users</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="earnings.php">earnings</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="post.php">post</a>
                            </li>
                            
                            <?php } ?>
                            
                            <li class="nav-item">
                                <a class="nav-link" onclick="document.location = 'logout.php' " id='logout'>logout</a>
                            </li>
                            <?php } else { ?>
                          	<li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="vendors.php">buy coupons</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="how.php">how it works</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">contact us</a>
                            </li>

                            <?php } ?>
                        </ul>
                        <!-- <form class="form-inline">
                            <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->