<?php
namespace App\Core;

use App\Core\Database;

class Gateway extends Database
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new Database();
    }
    public function execute($query)
    {
        $result = $this->mysqli->query($query);
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function fetch($query)
    {
        $data = [];
        $result = $this->mysqli->query($query);

        if (!$result) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }

        return $data;
    }

    public function check($query)
    {
        $result = $this->mysqli->query($query);
        $exists = $result->num_rows;
        
        if (!$exists) {
            return false;
        }

        return true;
    }
}