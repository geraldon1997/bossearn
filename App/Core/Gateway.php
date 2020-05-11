<?php
namespace App\Core;

use App\Core\DB;

class Gateway extends DB
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

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function checkExists($sql)
    {
        $result = self::init()->query($sql);
        return $result->num_rows;
    }
}
