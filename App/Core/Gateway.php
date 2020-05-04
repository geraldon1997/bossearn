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
        $result = $this->run($sql);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
