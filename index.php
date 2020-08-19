<?php

use App\Controllers\Seed;
use App\Core\Route;
use App\Models\Comment;

require_once 'App/autoload.php';

new Seed();


$route = new Route();
echo $route->get();
