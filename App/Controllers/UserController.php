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

                    // Earning::insert($refferred);
                    // Earning::updateBref(10000, $referrer);
                    self::$success['signup'] = 'Registeration was successful';
                    echo "<script> window.location = 'verify.php'; </script>";
                    $_SESSION['uname'] = $data['username'];
                } else {
                    self::$error['signup'] = 'username or email already exists';
                }
            } else {
                $signup = User::insert($refcode, $data);
                if ($signup) {
                    $referrer = Referral::refId(726348);
                    $refferred = User::lastUserId()[0]['id'];

                    Referral::insert($referrer, $refferred);

                    // Earning::insert($refferred);
                    // Earning::updateBref(10000, $referrer);
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
        $date = date('Y-m-d');
        $data['username'] = strtolower($data['username']);

        $login = User::findLoginUser('uname', $data['username']);
        
        if ($login[0]['uname'] === $data['username'] && $login[0]['paswd'] === $data['password']) {
          if (Role::role(User::findUser('uname', $data['username'])[0]['role_id'])[0]['role'] === 'user') {
            if (CouponController::userCouponStatus($data['username']) > 0) {
                $earnlog = $login[0];
                if ($earnlog['date'] != $date) {
                    Earning::updateBearn(100, User::userId($data['username'])[0]['id']);
                }
                
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
                            <form method="post" onsubmit="return confirm('do you really want to make this user a vendor ?');">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>" >
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
                            <form method="post" onsubmit="return confirm('do you really want to make this vendor a user ?');">
                            <input type="hidden" name="vid" value="<?php echo $uid; ?>" >
                            <button class="btn" >make user</button>
                            </form>
                            <br>
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
                            echo "<form method='post' onsubmit="return confirm('do you really want to make this user a vendor ?');">
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
                            <form method="post" onsubmit="return confirm('do you really want to make this vendor a user ?');">
                            <input type="hidden" name="vid" value="<?php echo $uid; ?>" >
                            <button class="btn" >make user</button>
                            </form>
                            <br>
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

    public static function forgotPassword($un)
    {
        $user = User::findLoginUser('uname', $un)[0];

        $to = $user['email'];

        $subject = 'Password Change Request';

        $headers = "From: Support <support@bossearn.com> \r\n";
        $headers .= "Reply-To: suppor@bossearn.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <!-- Basic -->
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    
                        <!-- Mobile Metas -->
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    
                        <!-- Site Metas -->
                        <title>Bossearn</title>
                        <meta name="keywords" content="">
                        <meta name="description" content="">
                        <meta name="author" content="">
                    
                        <!-- Site Icons -->
                        <link rel="shortcut icon" href="https://bossearn.com/App/Assets/Images/logo.jpeg" type="image/x-icon" />
                        <link rel="apple-touch-icon" href="https://bossearn.com/App/Assets/Images/logo.jpeg">
                    
                        <!-- Design fonts -->
                        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
                    
                        <!-- Bootstrap core CSS -->
                        <link href="https://bossearn.com/App/Assets/Css/bootstrap.css" rel="stylesheet">
                    
                        <!-- FontAwesome Icons core CSS -->
                        <link href="https://bossearn.com/App/Assets/Css/font-awesome.min.css" rel="stylesheet">
                    
                        <!-- Custom styles for this template -->
                        <link href="https://bossearn.com/App/Assets/Css/style.css" rel="stylesheet">
                    
                        <!-- Animate styles for this template -->
                        <link href="https://bossearn.com/App/Assets/Css/animate.css" rel="stylesheet">
                    
                        <!-- Responsive styles for this template -->
                        <link href="https://bossearn.com/App/Assets/Css/responsive.css" rel="stylesheet">
                    
                        <!-- Colors for this template -->
                        <link href="https://bossearn.com/App/Assets/Css/colors.css" rel="stylesheet">
                    
                        <!-- Version Marketing CSS for this template -->
                        <link href="https://bossearn.com/App/Assets/Css/version/marketing.css" rel="stylesheet">
                    
                    
                        <link rel="stylesheet" href="https://bossearn.com/App/Assets/Css/share-button.min.css" type="text/css" media="all"/>
                        <!-- <script src="https://bossearn.com/App/Assets/Js/jquery.min.js"></script> -->
                        
                    
                    
                    <style>
                        #logo{
                            width: 100px;
                            height: 70px;
                        }
                    </style>
                    
                    </head>
                    <body>
                    
                        <div id="wrapper">
                            <header class="market-header header">
                                <div class="container-fluid">
                                    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <a class="navbar-brand" href="https://bossearn.com"><img src="https://bossearn.com/App/Assets/Images/version/logo.jpeg" alt="bossearn" id="logo"></a>
                                        <div class="collapse navbar-collapse" id="navbarCollapse">
                                            
                                            <!-- <form class="form-inline">
                                                <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                            </form> -->
                                        </div>
                                    </nav>
                                </div><!-- end container-fluid -->
                            </header><!-- end market-header -->';

        $message .= "<a href='https://bossearn.com/reset.php?u=$un' class='btn'>click here to reset your password</a>";
        
        $message .= '<footer class="footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        
                                        <div class="copyright">&copy; Bossearn 2020</div>
                                    </div>
                                </div>
                            </div><!-- end container -->
                        </footer><!-- end footer -->

                        <div class="dmtop"></div>
                        
                    </div><!-- end wrapper -->

                    <!-- Core JavaScript
                    ================================================== -->
                    <script src="App/Assets/Js/share-button.min.js"></script>
                    <script src="App/Assets/Js/jquery.min.js"></script>
                    <script src="App/Assets/Js/tether.min.js"></script>
                    <script src="App/Assets/Js/bootstrap.min.js"></script>
                    <script src="App/Assets/Js/animate.js"></script>
                    <script src="App/Assets/Js/custom.js"></script>
                    </body>
                    </html>';
        

        mail($to, $subject, $message, $headers);

    }
}