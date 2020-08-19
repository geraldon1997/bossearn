<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Transaction extends QueryBuilder
{
    public static $table = 'transactions';

    public static function transactionsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT NOT NULL, ";
        $data .= "transaction_type VACHAR(10) NOT NULL, ";
        $data .= "amount INT NOT NULL, ";
        $data .= "date_updated TIMSTAMP NOT NULL, ";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id)";

        return self::create(self::$table, $data);
    }
}