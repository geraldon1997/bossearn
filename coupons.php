<?php

use App\Controllers\CouponController;

require_once 'layout/header.php';
?>

<style>
    table{
        width: 100%;
    }
    th{
        padding: 20px;
    }
    td{
        padding: 10px;
    }
    button{
    }
@media (max-width: 700px){
    button{
        margin-bottom: 10px;
    }
}
</style>

<div class="page-wrapper text-center center">

    <h1>Coupons</h1>

    <div class="row">
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="coupon" value="1">
                <button type="submit" class="btn">used coupons</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="coupon" value="0">
                <button type="submit" class="btn">unused coupons</button>
            </form>
        </div>
    </div>

    <br>
    <hr class="">

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <table border="1">
                <th>S/N</th>
                <th>Coupon</th>
                <th>used by</th>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        CouponController::view('is_verified', $_POST['coupon']);
                    }
                ?>
            </table>
        </div>

        <div class="col-md-3"></div>
    </div>
    
</div>

<?php require_once 'layout/footer.php'; ?>