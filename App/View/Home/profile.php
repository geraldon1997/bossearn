<?php

use App\Controller\CouponController;
use App\Core\Layout;
use App\Controller\UserController;
use App\Controller\BankController;

$profile = UserController::getProfile($_SESSION['uname']);
require_once Layout::start('home.header');
?>
<style>
.content{
    width: 100%;
    margin-top: 100px;
    margin-bottom: 100px;
    display: grid;
    grid-template-rows: auto;
    text-align: center;
    height: auto;
    color: black;
}
.profile{
    width: 100%;
    margin: 0 auto;
}
.profile .input-group{
    width: 50%;
    margin: 0 auto;
    margin-bottom: 10px;
    display: grid;
    grid-template-columns: 20% 80%;
}

.bank .input-group{
    width: 50%;
    margin: 0 auto;
    margin-bottom: 10px;
    display: grid;
    grid-template-columns: 20% 80%;
}

@media (max-width: 700px) {
    .profile .input-group{
        width:100%;
        margin: 0 auto;
        display: block;
    }

    .bank .input-group{
        width:100%;
        margin: 0 auto;
        display: block;
    }
}
</style>
<div class="content">
    <div class="earnings">
    <h1>earnings</h1>
    </div>
    <div class="profile">
    <h1>Personal Information</h1>
        <form action="" method="post">
        <div class="input-group">
            <label for="firstname">Referral Code:</label>
            <input type="text" value="<?php echo $profile['ref'] ?>" disabled>
        </div>
        <div class="input-group">
            <label for="firstname">First Name:</label>
            <input type="text" name="fname" value="<?php echo $profile['fname'] ?>">
        </div>
        <div class="input-group">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lname" value="<?php echo $profile['lname'] ?>">
        </div>
        <div class="input-group">
            <label for="email">email:</label>
            <input type="text" value="<?php echo $profile['email'] ?>" disabled>
        </div>
        <div class="input-group">
            <label for="phone">phone:</label>
            <input type="text" name="phone" value="<?php echo $profile['phone'] ?>">
        </div>
        <div class="input-group">
            <label for="username">UserName:</label>
            <input type="text" value="<?php echo $profile['uname'] ?>" disabled>
        </div>
        </form>
    </div>

    <div class="bank">
    <h1>Bank Information</h1>
    <?php if (CouponController::isCouponVerified($_SESSION['uname']) == true) { ?>
        <form action="" method="post">
            <div class="input-group">
                <label for="bank name">Bank Name : </label>
                    <?php if (BankController::isBankFilled($_SESSION['uname']) == false) { ?>
                        <input type="text" name="bank" placeholder="Bank Name">
                    <?php } else { ?>
                        <input type="text" value="<?php echo $bank['bank'] ?>" disabled>
                    <?php } ?>
            </div>

            <div class="input-group">
                <label for="account name">Account Name : </label>
                    <?php if (BankController::isBankFilled($_SESSION['uname']) == false) { ?>
                        <input type="text" name="bank" placeholder="Account Name">
                    <?php } else { ?>
                        <input type="text" name="bank" placeholder="Account Name">
                    <?php } ?>
            </div>

            <div class="input-group">
                <label for="accout number">Account Number : </label>
                    <?php if (BankController::isBankFilled($_SESSION['uname']) == false) { ?>
                        <input type="text" name="acctnum" placeholder="Account Number">
                    <?php } else { ?>
                        <input type="text" name="acctnum" placeholder="Account Number">
                    <?php } ?>
            </div>
            <?php if (BankController::isBankFilled($_SESSION['uname']) == false) { ?>
                <button>Add Bank Details</button>
            <?php } ?>
        </form>
    <?php } else { ?>
      <h1>please buy a coupon and verify to update your bank details</h1>
    <?php } ?>
    </div>
</div>

<?php require_once Layout::end('home.footer'); ?>