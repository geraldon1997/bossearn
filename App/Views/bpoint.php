<?php
use App\Models\User;
use App\Models\Earning;

$earning = Earning::all(Earning::$table)[0];

?>
<div class="content">
    <h1>Bpoint Withdrawals</h1>
    <hr>
    <?php if ($earning['is_bpoint']) : ?>
        <form action="<?= DEACTIVATE_BPOINT; ?>" method="post">
            <input type="hidden" name="status" value="0">
            <button type="submit" class="btn">Deactivate withdrawal</button>
        </form>
    <?php elseif (!$earning['is_bpoint']) : ?>
        <form action="<?= ACTIVATE_BPOINT; ?>" method="post">
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn">Activate withdrawal</button>
        </form>
    <?php endif; ?>
    <hr>
    <div class="row">
        <table border="1" class="m-auto">
            <th>s/n</th>
            <th>name</th>
            <th>Earning</th>
            <th>points</th>
            <th>Amount</th>
            <th>Status</th>
            <th>date requested</th>
            <th>action</th>
            <?php $sn = 1; ?>
            <?php foreach ($data as $bpoint) : ?>
                <?php $name = User::find(User::$table, 'id', $bpoint['users_id'])[0]; ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $name['surname'].' '.$name['othernames']; ?></td>
                    <td><?= $bpoint['type']; ?></td>
                    <td><?= number_format($bpoint['amount']); ?></td>
                    <td><?= number_format($bpoint['amount'] / 10); ?></td>
                    <td>
                        <?php
                        if ($bpoint['status']) {
                            echo 'paid';
                        } else {
                            echo 'pending';
                        }
                        ?>
                    </td>
                    <td><?= $bpoint['date_requested']; ?></td>
                    <td>
                        <?php if ($bpoint['status']) : ?>
                                paid
                        <?php else : ?>
                                <form action="<?= PAY; ?>" method="post">
                                <input type="hidden" name="wid" value="<?= $bpoint['id']; ?>">
                                <button type="submit" class="btn">Pay</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>