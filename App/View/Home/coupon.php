<?php

use App\Controller\CouponController;
use App\Core\Layout;
use App\Controller\UserController;

require_once Layout::start('home.header');

if (isset($_POST['coupon']) && isset($_POST['uname'])) {
    $cs = CouponController::sellCoupon($_POST['coupon'], $_POST['uname']);
}
?>
<style>
.content{
    width: 100%;
    margin-top: 100px;
    margin-bottom: 100px;
    text-align: center;
    height: auto;
    color: black;
}
.buttons{
    display: grid;
    grid-template-columns: 50% 50%;
}
</style>

<div class="content">
    <h1>Coupons</h1>
    <?php echo $cs; ?>
    <div class="buttons">
        <form action="" method="post">
            <input type="submit" name="sold_coupons" value="view sold coupons">
        </form>

        <form action="" method="post">
            <input type="submit" name="unsold_coupons" value="view unsold coupons">
        </form>
    </div>
    <hr>
    <table border="1" style="width: 50%; margin: 0 auto;">
        <?php CouponController::viewCoupons(); ?>
    </table>
</div>
<?php require_once Layout::end('home.footer');
