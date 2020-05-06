<?php
namespace App\Core;

use App\Core\DB;

class Gateway extends DB
{
    public function run($sql)
    {
        $result = $this->init()->query($sql);

        if (!$result) {
            return false;
        }

        return $result;
    }

    public function fetch($sql)
    {
        $result = $this->init()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function checkExists($sql)
    {
        $result = $this->init()->query($sql);
        return $result->num_rows;
    }
}
