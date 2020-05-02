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
        $result = Db::init()->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc) {
            $data[] = $row;
        }
        return $data;
    }
}
