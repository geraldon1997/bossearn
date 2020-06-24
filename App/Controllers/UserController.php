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
        self::$error['signup'] = 'testing';
            $data['username'] = strtolower($data['username']);
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
        $data['username'] = strtolower($data['username']);

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

    public static function validate($ref, $data)
    {
        foreach ($data as $key => $value) {
            if ($data[$key] = '' || $data[$key] === null || empty($data[$key])) {
                $msg = "$key should not be empty";
                self::$error[$key] = $msg;
                unset($data[$key]);
            } else {
                $data[$key] = $value;
            }
        }
        
        if (empty(self::$error)) {
            self::register($ref, $data);
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

    public static function view($rid)
    {
        $users = User::findUser('role_id', $rid);
        $sn = 1;

        if (!empty($users)) {
            foreach ($users as $key) {
                $uid = $key['id'];
                $ref = $key['ref'];
                $fn = $key['fname'];
                $ln = $key['lname'];
                $em = $key['email'];
                $ph = $key['phone'];
                $un = $key['uname'];
    
                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$ref</td>
                        <td>$fn $ln</td>
                        <td>$em</td>
                        <td>$ph</td>
                        <td>$un</td>
                        <td>";
                        if ($rid == 3) {?>
                            <form method="post">
                            <input type="hidden" name="uid" value="$uid" >
                            <button class="btn" >make vendor</button>
                            </form>
                            <br>
                            <a class="btn" href="edituser.php?uid=<?php echo $uid; ?>" >edit user</a>
                            <br><br>
                            <form method="post" onsubmit="return confirm('do you really want to delete this user ?');">
                            <input type="hidden" name="delid" value="<?php echo $uid ?>" >
                            <button type="submit" class="btn"  >delete user</button>
                            </form>
                        <?php
                        } elseif ($rid == 2) { ?>
                            <a class='btn' href='edituser.php?uid=<?php echo $uid; ?>'>edit vendor</a>
                            <br>
                            <form method='post' onsubmit="return confirm('do you really want to delete this user ?');">
                            <input type='hidden' name='delid' value='<?php echo $uid; ?>' >
                            <button type='submit' class='btn' >delete vendor</button>
                            </form>";
                        <?php
                        }
                            

                        "</td>
                </tr>";
            }
        }

        
    }

    public static function searchUser($un)
    {
        $user = User::findUser('uname', $un);
        $sn = 1;

        if (!empty($user)) {
            foreach ($user as $key) {
                $uid = $key['id'];
                $ref = $key['ref'];
                $fn = $key['fname'];
                $ln = $key['lname'];
                $em = $key['email'];
                $ph = $key['phone'];
                $un = $key['uname'];
                $rid = $key['role_id'];
    
                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$ref</td>
                        <td>$fn $ln</td>
                        <td>$em</td>
                        <td>$ph</td>
                        <td>$un</td>
                        <td>";
                        if ($rid == 3) { ?>
                            echo "<form method='post'>
                            <input type='hidden' name='uid' value='<?php echo $uid; ?>' >
                            <button type='submit' class='btn'>make vendor</button>
                            </form>
                            <br>
                            <a class='btn' href='edituser.php?uid=<?php echo $uid; ?>'>edit user</a>
                            <br><br>
                            <form method='post' onsubmit="return confirm('do you really want to delete this user ?');">
                            <input type='hidden' name='delid' value='<?php echo $uid; ?>' >
                            <button type='submit' class='btn'>delete user</button>
                            </form>
                            ";
                        <?php
                        } elseif ($rid == 2) { ?>
                            <a class='btn' href='edituser.php?uid=<?php echo $uid; ?>'>edit vendor</a>
                            <br>
                            <form method='post' onsubmit="return confirm('do you really want to delete this user ?');">
                            <input type='hidden' name='delid' value='$uid' >
                            <button type='submit' class='btn'>delete vendor</button>
                            </form>";
                        <?php
                        } elseif ($rid == 1) {
                            echo "you are admin";
                        }
                            

                        "</td>
                </tr>";
            }
        }
    }
}