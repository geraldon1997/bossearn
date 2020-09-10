<?php
use App\Models\User;
use App\Core\Controller as C;

$c = new C;
?>
<div class="content">
    <h1>Users</h1>
    <h4>Total : <?= User::total(); ?></h4>
    <hr>
    <div class="row">
        <div class="col">
            <form action="<?= VIEW_USERS; ?>" method="post">
                <input type="hidden" name="role" value="3">
                <input type="hidden" name="isactive" value="1">
                <button type="submit" class="btn">View active users</button>
            </form>
        </div>
        <div class="col">
            <form action="<?= VIEW_USERS; ?>" method="post">
                <input type="hidden" name="role" value="3">
                <input type="hidden" name="isactive" value="0">
                <button type="submit" class="btn">View inactive users</button>
            </form>
        </div>
        <div class="col">
            <form action="<?= VIEW_USERS; ?>" method="post">
                <input type="hidden" name="role" value="2">
                <input type="hidden" name="isactive" value="1">
                <button type="submit" class="btn">View vendors</button>
            </form>
        </div>
    </div>
    <hr>
    <?php if ($c->postData['role'] == 3 && $c->postData['isactive'] == 1) : ?>
        <h6><?= count($data); ?> active users</h6>
    <?php elseif ($c->postData['role'] == 3 && $c->postData['isactive'] == 0) : ?>
        <h6><?= count($data); ?> inactive users</h6>
    <?php elseif ($c->postData['role'] == 2 && $c->postData['isactive'] == 1) : ?>
        <h6><?= count($data); ?> vendors</h6>
    <?php endif; ?>
    <hr>
    <div class="row">
        <table border="1" class="m-auto">
            <th>sn</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>action</th>
        </table>
    </div>
</div>