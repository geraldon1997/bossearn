<?php
namespace App\Core;

use App\Core\Gateway;

class QueryBuilder extends Gateway
{
    
    public static function create(string $table, $data)
    {
        $query = "CREATE TABLE IF NOT EXISTS $table ($data)";
        $result = self::execute($query);
        return $result;
    }

    public static function insert(string $table, array $columns, array $values)
    {
        $col = implode(',', $columns);
        $val = implode("','", $values);
        $query = "INSERT INTO $table ($col) VALUES ('$val') ";
        $result = self::execute($query);
        return $result;
    }

    public static function update(string $table, $set, string $col, string $val)
    {
        $query = "UPDATE TABLE $table SET $set WHERE $col = '$val' ";
        $result = self::execute($query);
        return $result;
    }

    public static function all($table)
    {
        $query = "SELECT * FROM $table ORDER BY `id` DESC";
        return self::fetch($query);
    }

    public static function find($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE $col = '$val' ";
        return self::fetch($query);
    }

    public static function findMultiple($table, $data)
    {
        $query = "SELECT * FROM $table WHERE $data ";
        return self::fetch($query);
    }

    public static function exists($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE $col = '$val' ";
        return self::check($query);
    }

    public static function delete($table, $col, $val)
    {
        $query = "DELETE FROM $table WHERE $col = '$val' ";
        return self::fetch($query);
    }
}