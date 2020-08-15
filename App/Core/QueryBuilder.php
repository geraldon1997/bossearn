<?php
namespace App\Core;

use App\Core\Gateway;

class QueryBuilder extends Gateway
{
    public function create(string $table, $data)
    {
        $query = "CREATE TABLE IF NOT EXISTS $table ($data)";
        $result = $this->execute($query);
        return $result;
    }

    public function insert(string $table, array $columns, array $values)
    {
        $col = implode(',', $columns);
        $val = implode("','", $values);
        $query = "INSERT INTO $table ($col) VALUES ('$val') ";
        $result = $this->execute($query);
        return $result;
    }

    public function update(string $table, $set, string $col, string $val)
    {
        $query = "UPDATE TABLE $table SET $set WHERE $col = '$val' ";
        $result = $this->execute($query);
        return $result;
    }

    public function all($table)
    {
        $query = "SELECT * FROM $table ORDER BY `id` DESC";
        return $this->fetch($query);
    }

    public function find($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE '$col' = '$val' ";
        return $this->fetch($query);
    }

    public function exists($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE '$col' = '$val' ";
        return $this->check($query);
    }

    public function delete($table, $col, $val)
    {
        $query = "DELETE FROM $table WHERE '$col' = '$val' ";
        return $this->fetch($query);
    }
}