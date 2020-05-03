<?php
namespace App\Models;

use App\Core\Db;

class Gateway extends Db
{
    public static function run($sql)
    {
        $result = self::init()->query($sql);

        if (!$result) {
            return false;
        }

        return $result;
    }

    public static function fetch($sql)
    {
        $result = self::init()->query($sql);
        $datas = [];

        while ($row = $result->fetch_assoc()) {
            $datas[] = $row;
        }
        return $datas;
    }
}
