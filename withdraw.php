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
        echo "<script>window.location = 'pofile.php' </script> ";
    } elseif (isset($_POST['bn'])) {
        Bank::insert(User::userId($_SESSION['uname'])[0]['id'], $_POST);
        echo "<script>window.location = 'pofile.php' </script> ";
    }

    if (isset($_POST['withdraw'])) {
        $w = Earning::withdraw($_POST['withdraw'], User::userId($_SESSION['uname'])[0]['id']);
        echo "<script>alert('withdrawal request sent successfully');</script>";
        echo "<script>window.location = 'pofile.php' </script> ";
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
                    
                    <?php if ($earning[0]['status'] == 0 && $brefcash >= 3000) {?>
                        <form method="post" >
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
                    <?php if ($earning[0]['date'] >= (time() + 60 * 60 * 24 * 30) && $earning[0]['status'] == 0) {?>
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


<?php } ?>



    <hr class="invis">

</div>

<?php require_once 'layout/footer.php'; ?>