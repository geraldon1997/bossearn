<?php

use App\Controllers\Coupon as ControllersCoupon;
use App\Controllers\Seed;
use App\Core\QueryBuilder;
use App\Core\Route;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Point;
use App\Models\Subscription;

require_once 'App/autoload.php';

new Seed();



$route = new Route();
echo $route->get();
