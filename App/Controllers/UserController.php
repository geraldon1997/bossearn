<?php
namespace App\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Referral;
use App\Models\Earning;
use App\Models\Role;

class UserController extends User
{
    public static $success;
    public static $error;

    public static function register($ref, $data)
    {
        $refcode = rand(000000, 999999);
        $refExist = Referral::refExist($ref);
        if ($refExist) {
            $signup = User::insert($refcode, $data);
            if ($signup) {
                $referrer = Referral::refId($ref);
                $refferred = User::lastUserId()[0]['id'];

                Referral::insert($referrer, $refferred);

                Earning::insert($refferred);
                Earning::updateBref(10000, $referrer);
                self::$success['signup'] = 'Registeration was successful';
                echo "<script> window.location = 'verify.php'; </script>";
                $_SESSION['uname'] = $data['username'];
            } else {
                self::$error['signup'] = 'username or email already exists';
            }
        } else {
            $signup = User::insert($refcode, $data);
            if ($signup) {
                $referrer = Referral::refId(Referral::assignRef());
                $refferred = User::lastUserId()[0]['id'];

                Referral::insert($referrer, $refferred);

                Earning::insert($refferred);
                Earning::updateBref(10000, $referrer);
                self::$success['signup'] = 'Registeration was successful';

                echo "<script> window.location = 'verify.php'; </script>";
                $_SESSION['uname'] = $data['username'];
            } else {
                self::$error['signup'] = 'username or email already exists';
            }
        }
    }

    public static function login($data)
    {
        $login = User::findUser('uname', $data['username']);
        if ($login[0]['uname'] === $data['username'] && $login[0]['paswd'] === $data['password']) {
          if (Role::role(User::findUser('uname', $data['username'])[0]['role_id'])[0]['role'] === 'user') {
            if (CouponController::userCouponStatus($data['username']) > 0) {
                Earning::updateBearn(100, User::userId($data['username'])[0]['id']);
                echo "<script>window.location = '/';</script>";
                $_SESSION['uname'] = $data['username'];
            } else {
                echo "<script>window.location = 'verify.php';</script>";
                $_SESSION['uname'] = $data['username'];
            }
        } else {
            	echo "<script>window.location = '/';</script>";
                $_SESSION['uname'] = $data['username'];
          }
            } else {
            self::$error['login'] = 'username or password is incorrect';
        }
    }

    public static function vendors()
    {
        $vendor = User::findUser('role_id', 2);
        foreach ($vendor as $key) {
            $uid = $key['id'];
            $fn = $key['fname'];
            $ln = $key['lname'];
            $ph = $key['phone'];

            $bank = Bank::findBank('user_id', $uid)[0];
            $bn = $bank['bank'];
            $an = $bank['acct_name'];
            $acn = $bank['acct_num'];

            echo "<tr>
                <td>$fn</td>
                <td>$ln</td>
                <td>$bn</td>
                <td>$an</td>
                <td>$acn</td>
                <td><a href='https://api.whatsapp.com/send?phone=$ph&text=Hello, i am from bossearn and i want to buy coupon&source=&data=' class='btn' target='_blank'>chat</a></td>
            </tr>";
        }
    }

}