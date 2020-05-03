<?php
namespace App\Models;

use App\Core\Db;

class Gateway
{
    public static function run($sql)
    {
      $result = Db::init()->query($query);

        if (!$result) {
            return false;
        }

        return $result;
    }

    public static function fetch($sql)
    {
      $result = self::run($sql);
      $datas = [];

      while ($row = $result->fetch_assoc()) {
        $datas[] = $row;
      }
      return $datas;
    }
}