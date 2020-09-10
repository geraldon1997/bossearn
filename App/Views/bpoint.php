<?php
use App\Models\User;
?>
<div class="content">
    <h1>Bpoint Withdrawals</h1>
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
            <?php foreach ($data as $bref) : ?>
                <?php $name = User::find(User::$table, 'id', $bref['users_id'])[0]; ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $name['surname'].' '.$name['othernames']; ?></td>
                    <td><?= $bref['type']; ?></td>
                    <td><?= number_format($bref['amount']); ?></td>
                    <td><?= number_format($bref['amount'] / 10); ?></td>
                    <td>
                        <?php
                            if ($bref['status']) {
                                echo 'paid';
                            } else {
                                echo 'pending';
                            }
                        ?>
                    </td>
                    <td><?= $bref['date_requested']; ?></td>
                    <td>pay</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>