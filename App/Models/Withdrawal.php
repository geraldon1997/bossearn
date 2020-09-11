<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Withdrawal extends QueryBuilder
{
    public static $table = 'withdrawals';

    public static function withdrawalsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "users_id INT NOT NULL, ";
        $data .= "type VARCHAR(10) NOT NULL, ";
        $data .= "amount INT NOT NULL, ";
        $data .= "status BOOLEAN NOT NULL, ";
        $data .= "date_requested DATE NOT NULL, ";
        $data .= "date_paid DATE NULL";

        return self::create(self::$table, $data);
    }

    public static function addWithdrawal($type, $amount)
    {
        $columns = self::columns(self::$table);
        array_pop($columns);
        $earning = Earning::authAll()[0];
        $values = [
            'userid' => $earning['user_id'],
            'type' => $type,
            'amount' => $amount,
            'status' => 0,
            'date_req' => date('Y-m-d')
        ];
        
        $add = self::insert(self::$table, $columns, $values);
        
        if ($add) {
            if ($type === 'bref') {
                return Earning::updateEarning($type, 0, USERID);
            }

            if ($type === 'bpoint') {
                $rpoint = $earning['bpoint'] - $amount;
                return Earning::updateEarning($type, $rpoint, USERID);
            }
        }

        return false;
    }

    public static function paid()
    {
        //
    }

    public static function total()
    {
        $amount = 0;
        $total = self::findMultiple(self::$table, "status = 1 AND users_id = '".USERID."'");
        foreach ($total as $key) {
            $amount = $amount + $key['amount'];
        }
        return $amount;
    }

    public static function bref()
    {
        return self::findMultiple(self::$table, "type = 'bref' ");
    }

    public static function bpoint()
    {
        return self::findMultiple(self::$table, "type = 'bpoint' ");
    }
}
