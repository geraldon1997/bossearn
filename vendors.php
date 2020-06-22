<?php
require_once 'layout/header.php';

use App\Controllers\UserController;

?>

<style>
    
</style>

<div class="page-wrapper">
<h3>Vendors</h3>
    <div class="row">
    <div class="col-lg-3"></div>

        <div class="col-lg-6 tbl">
            <table border="1" >
                <th>first name</th>
                <th>last name</th>
                <th>bank name</th>
                <th>account name</th>
                <th>account number</th>
                <th>action</th>
                <?php UserController::vendors(); ?>
            </table>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>