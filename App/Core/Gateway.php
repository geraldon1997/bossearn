<?php
namespace App\Core;

use App\Core\Database;

class Gateway extends Database
{
   
    protected static function execute($query)
    {
        $result = self::init()->query($query);
        if (!$result) {
            return false;
        }
        return $result;
    }

    protected static function fetch($query)
    {
        $data = [];
        $result = self::init()->query($query);

        if (!$result) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }

        return $data;
    }

    protected static function check($query)
    {
        $result = self::init()->query($query);
        $exists = $result->num_rows;
        
        if ($exists < 1) {
            return false;
        }

        return true;
    }
}