<?php
require_once 'autoload.php';

use App\Models\Coupon;

Coupon::createTable();
echo Coupon::insert(10);
