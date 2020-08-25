<?php
namespace App\Models;

use App\Core\QueryBuilder;

class Subscription extends QueryBuilder
{
    public static $table = 'subscriptions';

    public static function subscriptionTable()
    {
        $data = "id TINYINT PRIMARY KEY AUTO_INCREMENT, ";
        $data .= "amount INT NOT NULL, ";
        $data .= "subscription_link VARCHAR(255) NOT NULL";
        
        return self::create(self::$table, $data);
    }

    public static function allId()
    {
        $id = [];
        $result = self::all(self::$table);
        foreach ($result as $key => $value) {
            array_push($id, $key);
        }
        return $id;
    }

    public static function allSubscription()
    {
        return self::all(self::$table);
    }

    public static function amount($id)
    {
        $result = self::find(self::$table, 'id', $id);
        return $result[0]['amount'];
    }

    public static function subscriptionId($amount)
    {
        $result = self::find(self::$table, 'amount', $amount);
        return $result[0]['id'];
    }

}