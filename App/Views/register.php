<style>
p{
    color: red;
}
</style>
<div class="content">
<div class="row">
        <div class="col-lg-3"></div>

        <div class="col-lg-6">
            <form class="form-wrapper" method="POST" action="<?php

use App\Models\Subscription;

echo AUTH_REGISTER; ?>">

            <p><?php if (isset($data['regError'])) {echo $data['regError'];} ?></p>

            <h4>Registration form</h4>
                <input type="hidden" name="ref" value="<?php if (isset($_GET['ref'])) {echo $_GET['ref'];} ?>">
                <input type="text" class="form-control" placeholder="surname" name="surname" value="<?php if (isset($data['data']['surname'])) {echo $data['data']['surname'];} ?>">
                
                <p><?php if (isset($data['error']['surname'])) {echo $data['error']['surname'];} ?></p>
                
                <input type="text" class="form-control" placeholder="other names" name="othernames" value="<?php if (isset($data['data']['othernames'])) {echo $data['data']['othernames'];} ?>">
                
                <p><?php if (isset($data['error']['othernames'])) {echo $data['error']['othernames'];} ?></p>

                <input type="email" class="form-control" placeholder="Email address" name="email" value="<?php if (isset($data['data']['email'])) {echo $data['data']['email'];} ?>">
                
                <p><?php if (isset($data['error']['email'])) {echo $data['error']['email'];} ?></p>

                <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php if (isset($data['data']['phone'])) {echo $data['data']['phone'];} ?>">
                
                <p><?php if (isset($data['error']['phone'])) {echo $data['error']['phone'];} ?></p>

                <input type="text" class="form-control" placeholder="Username" name="username" value="<?php if (isset($data['data']['username'])) {echo $data['data']['username'];} ?>">
                
                <p><?php if (isset($data['error']['username'])) {echo $data['error']['username'];} ?></p>
                
                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if (isset($data['data']['password'])) {echo $data['data']['password'];} ?>">
                
                <p><?php if (isset($data['error']['password'])) {echo $data['error']['password'];} ?></p>

                <select name="subscription" id="" class="form-control">
                    <option value="<?php if (isset($data['data']['subscription']) && !empty($data['data']['subscription'])) {echo $data['data']['subscription'];} ?>"><?php if (isset($data['data']['subscription']) && !empty($data['data']['subscription'])) {echo Subscription::amount($data['data']['subscription']);} else {echo 'choose subscription amount';} ?></option>
                    <?php foreach (Subscription::allSubscription() as $key) : ?>
                    <option value="<?php echo $key['id'] ?>"><?php echo $key['amount']; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" class="btn btn-primary">Register <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
</div>


</div>