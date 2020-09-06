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
    @media (max-width: 700px){
        .btn{
            margin-bottom: 10px;
        }
    }
</style>
<div class="page-wrapper text-center center">

<?php if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] !== 'admin') {?>

<h1>Withdrawal</h1>

<hr>

<div class="row">
    <div class="col-md-6">
        <button data-toggle="collapse" data-target="#bref" class="btn">withdraw bref</button>
    </div>

    <div class="col-md-6">
        <button data-toggle="collapse" data-target="#bpoint" class="btn">withdraw bpoints</button>
    </div>
</div>

<hr>

<div class="row">
    <div class="col">
        <form action="" method="post" class="form-wrapper collapse" id="bref">
            <div class="col-md-3 m-auto">
                <input type="number" name="bref" id="" class="form-control" placeholder="Enter bref amount to withdraw">
                <button class="btn">Request withdrawal</button>
            </div>
        </form>

        <form action="" method="post" class="form-wrapper collapse" id="bpoint">
            <div class="col-md-3 m-auto">
                <input type="number" name="bpoint" id="" class="form-control" placeholder="Enter bpoint amount to withdraw">
                <button class="btn">Request withdrawal</button>
            </div>
        </form>
    </div>
</div>
<?php } ?>



    <hr class="invis">

</div>

<script>

</script>

<?php require_once 'layout/footer.php'; ?>