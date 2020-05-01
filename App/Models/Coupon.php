<?php
namespace App\Models;

use App\Models\Gateway;

class Coupon
{
  public static function createCoupon()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `coupon` VARCHAR(10) UNIQUE NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        `date_gen` TIMESTAMP NOT NULL
        )";
    return Gateway::run($sql);
  }

  public static function createVendorCoupon()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `vendor_coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `vendor_id` INT NOT NULL,
        `coupon_id` INT NOT NULL,
        `is_sold` BOOLEAN NOT NULL,
        FOREIGN KEY(`vendor_id`) REFERENCES vendors(`id`),
        FOREIGN KEY(`coupon_id`) REFERENCES coupons(`id`)
    )";
    return Gateway::run($sql);
  }

  public static function createUserCoupon()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `user_coupons` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT NOT NULL,
        `vc_id` INT NOT NULL,
        FOREIGN KEY(`user_id`) REFERENCES users(`id`),
        FOREIGN KEY(`vc_id`) REFERENCES vendor_coupons(`id`)
    )";
    return Gateway::run($sql);
  }
}