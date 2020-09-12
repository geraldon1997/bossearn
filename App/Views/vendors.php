<?php
use App\Models\User;
?>
<div class="content">
    <h1>Vendors</h1>

    <hr>
    
    <div class="row">
        <div class="tbl m-auto" style="overflow: auto;">
            <table border="1" class="m-auto" id="vendors">
                <th>s/n</th>
                <th>name</th>
                <th>bank</th>
                <th>account number</th>
                <th>action</th>
                <?php $sn = 1; ?>
                <?php foreach (User::vendors() as $vendor) : ?>
                <tr>
                <td><?= $sn++; ?></td>
                <td><?= $vendor['surname'].' '.$vendor['othernames'] ?></td>
                <td><?= $vendor['bank']; ?></td>
                <td><?= $vendor['account']; ?></td>
                <td><a class="btn" href="https://api.whatsapp.com/send?phone=<?= $vendor['phone']; ?>&&text=hello i want to buy bossearn coupon" target="_blank">chat</a></td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
    
    <hr>
    
</div>