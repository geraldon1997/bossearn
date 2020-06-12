<?php

use App\Models\Earning;
use App\Models\User;

require_once 'layout/header.php';

$user = User::findUser('uname', $_SESSION['uname'])[0];
$earning = Earning::findEarning($user['id'])[0];

?>
<style>
    .page-wrapper{
        margin-top: 100px;
    }
</style>
<div class="page-wrapper text-center center">

<div class="row text-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earnings in points</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Bref : </b></div>
                        <div class="col-lg-6"><b>Bearn : </b></div>
                    </div>
                    <hr>
                    <h5>Total : </h5>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget-no-style">
                <div class="newsletter-widget text-center align-self-center">
                    <h3>Earnings in cash</h3>
                    <div class="row">
                        <div class="col-lg-6"><b>Bref : </b></div>
                        <div class="col-lg-6"><b>Bearn : </b></div>
                    </div>
                    <hr>
                    <h5>Total : </h5>
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

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper" method="POST">
            <h4> Personal Details </h4>
                <input type="text" class="form-control" placeholder="referral code" disabled value="<?php echo $user['ref'] ?>">
                <input type="text" class="form-control" placeholder="First name" value="<?php echo $user['fname'] ?>" name="fn">
                <input type="text" class="form-control" placeholder="Last name" value="<?php echo $user['lname'] ?>" name="ln">
                <input type="text" class="form-control" placeholder="Country" disabled value="<?php echo $user['country'] ?>">
                <input type="email" class="form-control" placeholder="Email address" disabled value="<?php echo $user['email'] ?>">
                <input type="tel" class="form-control" placeholder="Phone" value="<?php echo $user['phone'] ?>" name="ph">
                <input type="text" class="form-control" placeholder="Username" disabled value="<?php echo $user['uname'] ?>">
                
                <button type="submit" class="btn btn-primary"> update <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>