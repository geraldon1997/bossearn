<?php

use App\Models\User;
use App\Models\Point;
use App\Models\Subscription;

?>
<div class="content">
    <h1>Referrals</h1>
    <h4>your referral link :  <span style="color:blue;">https://bossearn.com/page/register?ref=<?php echo User::authinfo()['ref'] ?></span></h4>
    <div class="tbl">
        <table border="1" class="m-auto">
            <th>s/n</th>
            <th>name</th>
            <th>bonus</th>
            <?php
                $sn = 1;
                $total = [];
            ?>
            <?php foreach ($data as $ref) : ?>
                    <?php
                    $referred = User::find(User::$table, 'id', $ref['referred'])[0];

                    if ($referred['is_active']) :
                        $bonus = Point::point('subscription_id', $referred['subscription_id'])[0];
                        $sub = Subscription::amount($referred['subscription_id']);
                        array_push($total, $bonus['referral_point']);
                        ?>

                
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $referred['surname'].' '.$referred['othernames'] ?></td>
                    <td><?php echo $bonus['referral_point']; ?></td>
                </tr>
                    <?php endif; ?>
                
            <?php endforeach; ?>
            <tr>
                <td class="text-center" colspan="2"><b>Total</b></td>
                <td><?php echo array_sum($total); ?></td>
            </tr>
        </table>
    </div>
</div>