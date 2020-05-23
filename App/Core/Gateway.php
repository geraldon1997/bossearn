<?php
namespace App\Core;

use App\Core\DB;

class Gateway
{
    public static function run($sql)
    {
        $result = DB::init()->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function fetch($sql)
    {
        $result = DB::init()->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        } else {
            return false;
        }
    }

    public static function check($sql)
    {
        $result = DB::init()->query($sql);
        return $result->num_rows;
    }
}
