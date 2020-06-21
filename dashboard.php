<?php

use App\Models\Bank;
use App\Models\Earning;
use App\Models\User;
use App\Models\Role;

require_once 'layout/header.php';

$user = User::findUser('uname', $_SESSION['uname'])[0];
$earning = Earning::findEarning(User::userId($_SESSION['uname'])[0]['id'])[0];
$totalearning = Earning::earnings(User::userId($_SESSION['uname'])[0]['id'])[0];
$bank = Bank::findBank('user_id', User::userId($_SESSION['uname'])[0]['id'])[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fn'])) {
        User::updateUser($_POST['fn'], $_POST['ln'], $_POST['ph'], $_SESSION['uname']);
        echo "<script>window.location = 'dashboard.php' </script> ";
    } elseif (isset($_POST['bn'])) {
        Bank::insert(User::userId($_SESSION['uname'])[0]['id'], $_POST);
        echo "<script>window.location = 'dashboard.php' </script> ";
    }
}

?>
<style>
    
</style>
<div class="page-wrapper text-center center">

<?php if (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] !== 'admin') {?>
<h1>Role : <?php echo Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role']; ?></h1>
<div class="row text-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earning in points</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Bref : <?php echo number_format($earning['bref']) ?> </b></div>
                        <div class="col-lg-6"><b>Bpoints : <?php echo number_format($earning['bearn']) ?></b></div>
                    </div>
                    <hr>
                    <h5>Total : <?php echo number_format($totalearning['totalearnings']) ?> </h5>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earning in cash</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Bref : &#8358; <?php echo number_format($earning['bref'] / 10); ?> </b></div>
                        <div class="col-lg-6"><b>Bpoints : &#8358; <?php echo number_format($earning['bearn'] / 10) ?></b></div>
                    </div>
                    <hr>
                    <h5>Total : &#8358; <?php echo number_format($totalearning['totalearnings'] / 10);  ?></h5>
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