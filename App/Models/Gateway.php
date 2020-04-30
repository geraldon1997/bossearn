<?php
namespace App\Models;

use App\Core\Db;

class Gateway
{
    public static function run($sql)
    {
        return Db::init()->query($sql);
    }

    public static function fetch($sql)
    {
        return Db::init()->query($sql);
    }
}
