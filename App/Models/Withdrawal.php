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

    public static function addWithdrawal($type)
    {
        $columns = self::columns(self::$table);
        array_pop($columns);
        $earning = Earning::authAll()[0];
        $values = [
            'userid' => $earning['user_id'],
            'type' => $type,
            'amount' => $earning[$type],
            'status' => 0,
            'date_req' => date('Y-m-d')
        ];
        
        $add = self::insert(self::$table, $columns, $values);
        
        if ($add) {
            Earning::updateEarning($type, 0, USERID);
            header('location:'.PREVIOUS_PAGE);
            return;
        }

        header('location:'.PREVIOUS_PAGE);
        return;
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
}
