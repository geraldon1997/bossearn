<?php

use App\Models\Bank;
use App\Models\Coupon;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\User;
use App\Models\Role;

require_once 'layout/header.php';

$user = User::findLoginUser('uname', $_SESSION['uname']);
$earning = Earning::findEarning(User::userId($_SESSION['uname'])[0]['id']);
$totalearning = Earning::earnings(User::userId($_SESSION['uname'])[0]['id']);
$bank = Bank::findBank('user_id', User::userId($_SESSION['uname'])[0]['id']);
$referral = Referral::findRef('referrer', $user[0]['id']);


    if (isset($_POST['fn'])) {
        User::updateUser($_POST['fn'], $_POST['ln'], $_POST['ph'], $_SESSION['uname']);
        echo "<script>window.location = 'dashboard.php' </script> ";
    } elseif (isset($_POST['bn'])) {
        Bank::insert(User::userId($_SESSION['uname'])[0]['id'], $_POST);
        echo "<script>window.location = 'dashboard.php' </script> ";
    }

    if (isset($_POST['withdraw'])) {
        $w = Earning::withdraw($_POST['withdraw'], User::userId($_SESSION['uname'])[0]['id']);
        echo "<script>alert('withdrawal request send successfully');</script>";
        echo "<script>window.location = 'dashboard.php' </script> ";
    }

    
if (!empty($earning[0])) {
    $brefpoint = $earning[0]['bref'];
    $brefcash = $earning[0]['bref'] / 10;

    $bearnpoint = $earning[0]['bearn'];
    $bearncash = $earning[0]['bearn'] / 10;
}


?>
<style>
    
</style>
<div class="page-wrapper text-center center">

<?php if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] !== 'admin') {?>
<h1>Role : <?php echo Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role']; ?></h1>
<h3>Username : <?php echo $_SESSION['uname']; ?></h3>
<h4>No of Referrals : <?php
$refcount = [];
$ref = Referral::findRef('referrer', User::userId($_SESSION['uname'])[0]['id']);
foreach ($ref as $key) {
    $cs = Coupon::userStatus($key['referred']);
    if ($cs > 0) {
        array_push($refcount, $cs);
    }
}
echo count($refcount);
?></h4>


<div class="row text-center">
<div class="col-lg-12">
<p><strong>Referral link : https://bossearn.com/register.php?ref=<?php echo $user[0]['ref'] ?></strong></p>
<ul class="check">
    <li><b><a href="https://www.instagram.com/BOSSEARN_CEO">click to follow us on instagram</a></b></li>
    <li><b><a href="https://www.facebook.com/groups/563831221190622/?ref=share">click to follow us on facebook</a></b></li>
</ul>
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
                <input type="text" class="form-control" placeholder="referral code" disabled value="<?php echo $user[0]['ref'] ?>">
                <label for="first name">First Name</label>
                <input type="text" class="form-control" placeholder="First name" value="<?php echo $user[0]['fname'] ?>" name="fn">
                <label for="Last name">Last Name</label>
                <input type="text" class="form-control" placeholder="Last name" value="<?php echo $user[0]['lname'] ?>" name="ln">
                <label for="country">Country</label>
                <input type="text" class="form-control" placeholder="Country" disabled value="<?php echo $user[0]['country'] ?>">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" placeholder="Email address" disabled value="<?php echo $user[0]['email'] ?>">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" placeholder="Phone" value="<?php echo $user[0]['phone'] ?>" name="ph">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" disabled value="<?php echo $user[0]['uname'] ?>">
                
                <button type="submit" class="btn btn-primary"> update profile <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>

    <hr class="invis">

    
    <div class="row">
        <div class="col-lg-3"></div>
        <?php if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'user') {?>
            
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
                    <input type="text" class="form-control" value="<?php echo $bank[0]['bank'] ?>" disabled>

                    <label for="account name">Account Name</label>
                    <input type="text" class="form-control"  value="<?php echo $bank[0]['acct_name'] ?>" disabled>

                    <label for="account number">Account Number</label>
                    <input type="text" class="form-control" value="<?php echo $bank[0]['acct_num'] ?>" disabled>
                </div>
                
                <?php } ?>

        </div>

        <?php } ?>
        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>