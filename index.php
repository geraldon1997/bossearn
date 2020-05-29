<?php

use App\Core\DBSeed;
use App\Models\Comment;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\Role;
use App\Models\User;

require_once 'autoload.php';

// DBSeed::seed();
$u = Comment::insert(1, 1, 'hello dear');
var_dump($u);
