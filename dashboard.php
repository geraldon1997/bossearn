<?php

use App\Models\Bank;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\User;
use App\Models\Role;

require_once 'layout/header.php';

$user = User::findUser('uname', $_SESSION['uname'])[0];
$earning = Earning::findEarning(User::userId($_SESSION['uname'])[0]['id'])[0];
$totalearning = Earning::earnings(User::userId($_SESSION['uname'])[0]['id'])[0];
$bank = Bank::findBank('user_id', User::userId($_SESSION['uname'])[0]['id'])[0];
$referral = Referral::findRef('referrer', $user['id']);


    if (isset($_POST['fn'])) {
        User::updateUser($_POST['fn'], $_POST['ln'], $_POST['ph'], $_SESSION['uname']);
        echo "<script>window.location = 'dashboard.php' </script> ";
    } elseif (isset($_POST['bn'])) {
        Bank::insert(User::userId($_SESSION['uname'])[0]['id'], $_POST);
        echo "<script>window.location = 'dashboard.php' </script> ";
    }

    if (isset($_POST['withdraw'])) {
        $w = Earning::withdraw($_POST['withdraw'], User::userId($_SESSION['uname'])[0]['id']);
    
    }

    

$brefpoint = $earning['bref'];
$brefcash = $earning['bref'] / 10;

$bearnpoint = $earning['bearn'];
$bearncash = $earning['bearn'] / 10;

?>
<style>
    
</style>
<div class="page-wrapper text-center center">

<?php if (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] !== 'admin') {?>
<h1>Role : <?php echo Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role']; ?></h1>
<h4>No of Referrals : <?php if (!empty($referral)) {echo count($referral);} else {echo 0;} ?></h4>
<div class="row text-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earning in Bref</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Points: <?php echo number_format($brefpoint) ?> </b></div>
                        <div class="col-lg-6"><b>Cash : &#8358; <?php echo number_format($brefcash); ?></b></div>
                    </div>
                    <hr>
                    <?php if ($earning['status'] == 0 && $brefcash >= 3000) {?>
                        <form method="post" action="">
                            <input type="hidden" name="withdraw" value="bref">
                            <button type="submit">withdraw</button>
                        </form>
                    <?php } ?>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earnings in Bpoints</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Points : <?php echo number_format($bearnpoint); ?> </b></div>
                        <div class="col-lg-6"><b>Cash : &#8358; <?php echo number_format($bearncash); ?></b></div>
                    </div>
                    <hr>
                    <?php if ($earning['date'] >= (time() + 60 * 60 * 24 * 30) && $earning['status'] == 0) {?>
                        <form method="post">
                            <input type="hidden" name="withdraw" value="bearn">
                            <button type="submit">withdraw</button>
                        </form>
                        
                    <?php } ?>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->
</div>

<div class="row text-center">
<div class="col-lg-12">
<p><strong>Referral link : https://bossearn.com/register.php?ref=<?php echo $user['ref'] ?></strong></p>
</div>
</div>
<?php } ?>

<div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6 " >
        
        <button data-toggle="collapse" data-target="#profile" class="btn">profile</button>

            <form class="form-wrapper collapse" method="POST" id="profile">
            <h4> Personal Details </h4>
                <label for="Referral Id">Referral Id</label>
                <input type="text" class="form-control" placeholder="referral code" disabled value="<?php echo $user['ref'] ?>">
                <label for="first name">First Name</label>
                <input type="text" class="form-control" placeholder="First name" value="<?php echo $user['fname'] ?>" name="fn">
                <label for="Last name">Last Name</label>
                <input type="text" class="form-control" placeholder="Last name" value="<?php echo $user['lname'] ?>" name="ln">
                <label for="country">Country</label>
                <input type="text" class="form-control" placeholder="Country" disabled value="<?php echo $user['country'] ?>">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" placeholder="Email address" disabled value="<?php echo $user['email'] ?>">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" placeholder="Phone" value="<?php echo $user['phone'] ?>" name="ph">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" disabled value="<?php echo $user['uname'] ?>">
                
                <button type="submit" class="btn btn-primary"> update profile <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>

    <hr class="invis">

    
    <div class="row">
        <div class="col-lg-3"></div>
        <?php if (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'user') {?>
            
        <div class="col-lg-6" >

        <?php if (Bank::isBankFilled('user_id', User::userId($_SESSION['uname'])[0]['id']) < 1) {?>

        <button data-toggle="collapse" data-target="#bank" class="btn">bank details</button>

            <form method="post" class="form-wrapper collapse" id="bank">
                <h4>Bank Details</h4>
                <label for="bank">Bank Name</label>
                <input type="text" class="form-control" placeholder="Bank Name" value="" name="bn">

                <label for="account name">Account Name</label>
                <input type="text" class="form-control" placeholder="Account name" value="" name="an">

                <label for="account number">Account Number</label>
                <input type="text" class="form-control" placeholder="Account Number" value="" name="acn">

                <button type="submit" class="btn btn-primary"> update bank <i class="fa fa-arrow-right"></i></button>
            </form>

            <?php } elseif (Bank::isBankFilled('user_id', User::userId($_SESSION['uname'])[0]['id']) > 0) {?>

                <button data-toggle="collapse" data-target="#bank" class="btn">bank details</button>

                <div id="bank" class="collapse">
                    <h4>Bank Details</h4>
                    <label for="bank">Bank Name</label>
                    <input type="text" class="form-control" value="<?php echo $bank['bank'] ?>" disabled>

                    <label for="account name">Account Name</label>
                    <input type="text" class="form-control"  value="<?php echo $bank['acct_name'] ?>" disabled>

                    <label for="account number">Account Number</label>
                    <input type="text" class="form-control" value="<?php echo $bank['acct_num'] ?>" disabled>
                </div>
                
                <?php } ?>

        </div>

        <?php } ?>
        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>