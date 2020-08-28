
    <div class="content">
        <div class="row">
            <div class="col-lg-3"></div>

            <div class="col-lg-6">

            <h4>Login form</h4>
            <p><?php if (isset($data['error'])) { echo $data['error']; } ?></p>
            <form class="form-wrapper" method="POST" action="<?php echo AUTH_LOGIN; ?>">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn">Login <i class="fa fa-arrow-right"></i></button>
            </form>
            <hr>
            <a href="forgotpassword.php" class="btn">Forgot Password ?</a>
            </div>

            <div class="col-lg-3"></div>
        </div>
    </div>
