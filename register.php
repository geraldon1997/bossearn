<?php

require_once 'layout/header.php';
?>
<style>
    .page-wrapper{
        margin-top: 100px;
    }
</style>
<div class="page-wrapper text-center center">

    <div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper">
            <h4>Registration form</h4>
                <input type="text" class="form-control" placeholder="First name">
                <input type="text" class="form-control" placeholder="Last name">
                <input type="text" class="form-control" placeholder="Country">
                <input type="email" class="form-control" placeholder="Email address">
                <input type="tel" class="form-control" placeholder="Phone">
                <input type="text" class="form-control" placeholder="Username">
                <input type="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn btn-primary">Register <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>