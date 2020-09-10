<?php
if (isset($data['error'])) {
    echo $data['error'];
}
?>

<div class="content">
    <h1>Withdrawals</h1>
    <hr>
    <form action="<?= WITHDRAW; ?>" method="post" class="form-wrapper m-auto col-md-6">
        <select name="type" id="withdrawal" class="form-control" required>
            <option value="">choose withdrawal type</option>
            <option value="bref">bref</option>
            <option value="bpoint">bpoint</option>
        </select>
        <input type="number" name="amount" id="amount" class="form-control" placeholder="enter current earning to withdraw" required>
        <button type="submit" class="btn">withdraw</button>
    </form>

    <hr>
    
    <div class="row">
        <table border="1" class="m-auto">
            <th>s/n</th>
            <th>Earning</th>
            <th>points</th>
            <th>Amount</th>
            <th>Status</th>
            <th>date requested</th>
            <?php

            use App\Models\Withdrawal;

            $sn =1; ?>
            <?php
                if (isset($data['error'])) {
                    array_pop($data);
                }
            ?>
            <?php foreach ($data as $withdraw) : ?>
                <tr>
                    <td><?= $sn++; ?></td>
                    <td><?= $withdraw['type']; ?></td>
                    <td><?= number_format($withdraw['amount']); ?></td>
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
                <td colspan="2"><b>Total withdrawn</b></td>
                <td><?= number_format(Withdrawal::total()); ?></td>
                <td><?= number_format(Withdrawal::total() / 10); ?></td>
                <td colspan="2"></td>
            </tr>
        </table>
    </div>
</div>

<script>
    var withdraw = $('#withdrawal');
    var amount = $('#amount');
    $(withdraw).change(function(){
        if (withdraw.val() === 'bpoint') {
            amount.prop('min', '10000')
        }
    });
</script>