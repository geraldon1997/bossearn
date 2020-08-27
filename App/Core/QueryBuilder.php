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
        // return $query;
    }

    public static function update(string $table, $set, string $col, string $val)
    {
        $query = "UPDATE $table SET $set WHERE $col = '$val' ";
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
        $result = self::check($query);

        return $result;
    }

    public static function delete($table, $col, $val)
    {
        $query = "DELETE FROM $table WHERE $col = '$val' ";
        return self::fetch($query);
    }

    public static function columns($table)
    {
        $query = "SHOW COLUMNS FROM $table";
        $result = self::fetch($query);

        $columns = [];
        for ($i=0; $i < count($result); $i++) { 
            array_push($columns, $result[$i]['Field']);
        }
        array_shift($columns);
        return $columns;
    }

}