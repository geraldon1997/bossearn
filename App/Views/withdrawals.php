<div class="content">
    <h1>Withdrawals</h1>
    <hr>
    <div class="row">
        <table border="1" class="m-auto">
            <th>s/n</th>
            <th>Earning</th>
            <th>Amount</th>
            <th>Status</th>
            <th>date requested</th>
            <?php

            use App\Models\Withdrawal;

            $sn =1; ?>
            <?php foreach ($data as $withdraw) : ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $withdraw['type']; ?></td>
                    <td><?= number_format($withdraw['amount'] / 10); ?></td>
                    <td>
                        <?php
                        if ($withdraw['status'] == 0) {
                            echo 'pending';
                        } else {
                            echo 'paid';
                        }
                        ?>
                    </td>
                    <td><?= $withdraw['date_requested']; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><b>Total withdrawn</b></td>
                <td colspan="3"><?= Withdrawal::total(); ?></td>
            </tr>
        </table>
    </div>
</div>