<div class="content">
<h1>User Profile</h1>

<?php

use App\Models\Bank;
use App\Models\User;

$dp = User::find(User::$dptable, 'user_id', USERID);

if ($dp) {
    $picture = $dp[0]['picture'];
}

?>

<div class="row">
    
    <div class="col">
    <h5>personal info</h5>

    <div class="row">
        <div class="col-md-3">
            <img 
                src="<?php
                if (isset($picture)) {
                    echo '/'.$picture;
                } else {
                    echo ASSETS.'/Images/logo.jpeg';
                }
                ?>"
                width="150"
                alt="<?php echo $_SESSION['uname']; ?>">
        </div>
        <div class="col">
            <form action="<?= UPDATE_DP; ?>" method="post" enctype="multipart/form-data" class="form-wrapper">
                <input type="file" name="image" class="form-control">
                <button type="submit" class="btn">update picture</button>
            </form>
        </div>
    </div>
       <hr>
    <form action="<?php echo UPDATE_PROFILE; ?>" method="post" class="form-wrapper">
        <input placeholder="surname" type="text" name="surname" class="form-control" value="<?php echo $data['surname'] ?>">
        <input placeholder="other names" type="text" name="othernames" class="form-control" value="<?php echo $data['othernames'] ?>">
        <input placeholder="email addresss" type="email" class="form-control" value="<?php echo $data['email'] ?>">
        <input placeholder="phone" type="tel" name="phone" class="form-control" value="<?php echo $data['phone'] ?>">
        <input placeholder="username" type="text" class="form-control" value="<?php echo $data['username'] ?>">
        <button type="submit" class="btn">update</button>
    </form>
    </div>
    
    <div class="col">
        <h5>bank info</h5>
        <?php if (Bank::isBankExist()) : ?>
            <form class="col form-wrapper">
                <input type="text" class="form-control" value="<?= Bank::info()['bank'] ?>">
                <input type="number" class="form-control" value="<?= Bank::info()['account'] ?>">
            </form>
        <?php else : ?>
            <form action="<?php echo ADD_BANK; ?>" method="post" class="col form-wrapper">
                <input type="text" name="bank" class="form-control" placeholder="bank name">
                <input type="number" name="account" class="form-control" placeholder="bank account number">
                <button type="submit" class="btn">update</button>
            </form>
        <?php endif; ?>
    </div>

</div>

</div>