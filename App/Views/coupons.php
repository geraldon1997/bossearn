<?php
use App\Models\Subscription;
use App\Models\User;

?>
<div class="content">
<h1>Coupons</h1>
<div class="row">
    <div class="col-md-6 m-auto">
    <p><?php if (isset($data['gen'])) {
        echo $data['gen'];
       } ?></p>

        <form action="<?php echo GENERATE_COUPON; ?>" method="post" class="form-wrapper">
            <select name="subscription" id="" class="form-control">
                <option value="<?php if (isset($data['data']['subscription']) && !empty($data['data']['subscription'])) {
                    echo $data['data']['subscription'];
                               } ?>"><?php if (isset($data['data']['subscription']) && !empty($data['data']['subscription'])) {
                               echo Subscription::amount($data['data']['subscription']);
                               } else {
                                   echo 'choose subscription amount';
                               } ?></option>
                <?php foreach (Subscription::allSubscription() as $key) : ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['amount']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="quantity" class="form-control" placeholder="enter number of coupons you wish to generate">
            <button type="submit" class="btn">Generate</button>
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="col">
        <form action="<?php echo VIEW_COUPON; ?>" method="post" class="form-wrapper">
            <input type="hidden" name="coupon" value="1">
            <button type="submit" class="btn">View used coupons</button>
        </form>
    </div>
    <div class="col">
        <form action="<?php echo VIEW_COUPON; ?>" method="post" class="form-wrapper">
            <input type="hidden" name="coupon" value="0">
            <button type="submit" class="btn">View available coupons</button>
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="m-auto">
        <?php if (isset($data)) : ?>
        <table border="1">
            <th>s/n</th>
            <th>coupon</th>
            <th>used by</th>
            <th>subscription amount</th>
            <th>date generated</th>
            <th>date used</th>
            <?php $sn = 1; foreach ($data as $key) : ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $key['coupon'] ?></td>
                    <td><?php if ($key['user_id'] == 1) {
                        echo 'NULL';
                        } else {
                            echo User::find(User::$table, 'id', $key['user_id'])[0]['username'];
                        } ?></td>
                    <td><?= Subscription::find(Subscription::$table, 'id', $key['subscription_id'])[0]['amount']; ?></td>
                    <td><?= $key['date_generated']; ?></td>
                    <td><?php if ($key['user_id'] == 1) {
                        echo 'not used';
                        } else {
                            echo $key['date_used'];
                        } ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>