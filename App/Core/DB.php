<?php
namespace App\Core;

use mysqli;
use App\Core\Config;

class DB
{
    public function init()
    {
        $mysqli = new mysqli('localhost', 'bossearnphp', 'bossearnphp', 'bossearnphp');

        if ($mysqli->connect_error) {
            echo "error in connection, please contact webmaster ". $mysqli->connect_errno;
        }
         return $mysqli;
    }
}
