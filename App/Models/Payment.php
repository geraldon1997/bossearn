<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Payment extends QueryBuilder
{
    public static $table = 'payments';

    public static function paymentsTable()
    {
        $data = "id INT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "user_id INT NOT NULL, ";
        $data .= "payment_type VARCHAR(15) NOT NULL, ";
        $data .= "subscription_id TINYINT NOT NULL, ";
        $data .= "reference_no VARCHAR(20) NOT NULL, ";
        $data .= "date_updated";
        $data .= "FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $data .= "FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON UPDATE CASCADE ON DELETE CASCADE";

        return self::create(self::$table, $data);
    }
}