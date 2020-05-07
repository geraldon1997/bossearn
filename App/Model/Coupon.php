<?php
namespace App\Model;

use App\Core\Gateway;

class Coupon extends Gateway
{
    public function createCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon` VARCHAR(10) UNIQUE NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_gen` TIMESTAMP
    )";
        $this->run($sql);
    }

    public function createVendorCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `vendors_coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon_id` INT NOT NULL,
        `vendor_id` INT NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_sold` TIMESTAMP
    )";
        $this->run($sql);
    }

    public function createUserCouponTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users_coupons` (
    	`id` INT PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `vendors_coupons_id` INT NOT NULL,
        `is_verified` BOOLEAN NOT NULL,
        `date_verified` TIMESTAMP
    )";
        $this->run($sql);
    }

    public function generateCoupon($coupon)
    {
        $sql = "INSERT INTO `coupons` (`coupon`, `is_sold`) VALUES ($coupon, false)";
        $this->run($sql);
    }

    public function sellCouponToVendor($cid, $vid)
    {
        $sql = "INSERT INTO `vendors_coupons` (`coupon_id`,`vendor_id`,`is_sold`) VALUES ($cid, $vid, false)";
        $this->run($sql);
        $sold = "UPDATE `coupons` SET `is_sold` = true WHERE `id` = '$cid' ";
        $this->run($sold);
    }

    public function sellCouponToUser($uid, $vcid)
    {
        $sql = "INSERT INTO `users_coupons` (`user_id`, `vendors_coupons_id`, `is_verified`) VALUES ('$uid', '$vcid', false)";
        $this->run($sql);
        $sold = "UPDATE `vendors_coupons` SET `is_sold` = true WHERE `id` = '$vcid'";
        $this->run($sold);
    }

    public function verifyUserCoupon()
    {
        $sql = "";
        $this->run($sql);
    }

    public function getUnsoldCoupon($ctable)
    {
        $sql = "SELECT * FROM $ctable WHERE `is_sold` = false";
        return $this->fetch($sql);
    }

    public function getSoldCoupon($ctable)
    {
        $sql = "SELECT * From $ctable WHERE `is_sold` = true";
        return $this->fetch($sql);
    }

    public function getId($table, $col, $val)
    {
        $sql = "SELECT * FROM $table WHERE $col = '$val' ";
        $id = $this->fetch($sql);
        foreach ($id as $key) {
            return $key['id'];
        }
    }
}
