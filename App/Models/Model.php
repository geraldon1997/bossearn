<?php
namespace App\Models;

use App\Core\Config;
use mysqli;

class Model
{
    public static function con()
    {
        Config::loadConf('database');
        $host = Config::getConf('driver.mysql.host');
        $user = Config::getConf('driver.mysql.user');
        $pass = Config::getConf('driver.mysql.pass');
        $db = Config::getConf('driver.mysql.db');

        return new mysqli($host, $user, $pass, $db);
    }

    public static function create($tableName, $data)
    {
        $sql = "CREATE TABLE IF NOT EXISTS $tableName ($data)";
        return self::con()->query($sql);
    }

    public static function insert($tableName, $columns, $values)
    {
        $col = implode(',', $columns);
        $val = implode("','", $values);
        $val .= "'".$val."'";

        $sql = "INSERT INTO $tableName ($col) VALUES ($val)";
        return self::con()->query($sql);
    }

    public static function update($tableName, $set, $where)
    {
        $sql = "UPDATE $tableName SET $set WHERE $where";
        return self::con()->query($sql);
    }

    public static function delete($tableName, $delete)
    {
        $sql = "DELETE FROM $tableName WHERE $delete";
        return self::con()->query($sql);
    }

    public static function all($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        return self::con()->query($sql);
    }

    public static function find($tableName, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE `id` = '$id' ";
        return self::con()->query($sql);
    }

    public static function where($tableName, $where)
    {
        $sql = "SELECT * FROM $tableName WHERE $where";
        return self::con()->query($sql);
    }
}
