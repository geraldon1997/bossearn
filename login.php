<?php

require_once 'layout/header.php';
?>
<style>
    .page-wrapper{
        margin-top: 100px;
        margin-bottom: 50px;
    }
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper">
            <h4>Login form</h4>
                <input type="text" class="form-control" placeholder="Username">
                <input type="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn btn-primary">Login <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>