<?php
namespace App\Core;

use mysqli;

class DB
{
    public static function init()
    {
        return new mysqli('localhost', 'bossearnphp', 'bossearnphp', 'bossearnphp');
    }
}
