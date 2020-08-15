<div class="content">
<div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper" method="POST" action="<?php echo AUTH_REGISTER; ?>">
            
            <h4>Registration form</h4>
                <input type="text" class="form-control" placeholder="surname" name="surname" value="<?php if (isset($_POST['firstname'])) {echo $_POST['firstname'];} ?>">
                
                <p></p>
                
                <input type="text" class="form-control" placeholder="other names" name="othernames" value="<?php if (isset($_POST['lastname'])) {echo $_POST['lastname'];} ?>">
                
                <p></p>

                <input type="email" class="form-control" placeholder="Email address" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>">
                
                <p></p>

                <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php if (isset($_POST['phone'])) {echo $_POST['phone'];} ?>">
                
                <p></p>

                <input type="text" class="form-control" placeholder="Username" name="username" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>">
                
                <p></p>
                
                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if (isset($_POST['password'])) {echo $_POST['password'];} ?>">
                
                <p></p>

                <select name="couponAmountId" id="" class="form-control">
                    <option value="">choose coupon amount to register with</option>
                    <option>&#8358; 1,500</option>
                    <option>&#8358; 2,500</option>
                    <option>&#8358; 3,500</option>
                </select>
                
                <button type="submit" class="btn btn-primary">Register <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>


</div>