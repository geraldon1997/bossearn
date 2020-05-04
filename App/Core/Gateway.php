<?php
namespace App\Core;

class Gateway
{
    public static function run($sql)
    {
        return DB::init()->query($sql);
    }

    public static function fetch($sql)
    {
        $result = DB::init()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
