<?php

use App\Controllers\UserController;
use App\Models\User;

require_once 'layout/header.php';

if (isset($_POST['uid'])) {
    User::makeVendor($_POST['uid']);
}

if (isset($_POST['vid'])) {
    User::makeUser($_POST['vid']);
}

if (isset($_POST['delid'])) {
    User::deleteUser($_POST['delid']);
}
?>

<style>
    table{
        width: 100%;
    }
    th{
        padding: 20px;
    }
    td{
        padding: 10px;
    }
    th, td{
        white-space: nowrap;
    }
    .col-md-6{
        overflow: auto;
    }
    button{
        margin-bottom: 0;
    }
    @media (max-width: 700px){
        button{
            margin-bottom: 10px;
        }
    }
</style>

<div class="page-wrapper text-center">

    <div class="row">
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="user" value="3">
                <button type="submit" class="btn">users</button>
            </form>
        </div>

        <div class="col-md-4">
            <form action="" method="post">
                <input type="text" name="username" placeholder="username">
                <button type="submit" class="btn">search</button>
            </form>
        </div>
        
        <div class="col-md-4">
            <form action="" method="post">
                <input type="hidden" name="user" value="2">
                <button type="submit" class="btn">vendors</button>
            </form>
        </div>
    </div>

<hr>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 tbl">
            <?php
                if (isset($_POST['user']) && $_POST['user'] === '2') {
                    echo "<h2>Vendors</h2>";
                } elseif (isset($_POST['user']) && $_POST['user'] === '3') {
                    echo "<h2>Users</h2>";
                }
            ?>
            <table border="1">
                <th>S/N</th>
                <th>Reference</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>username</th>
                <th>Action</th>
                <?php
                if (isset($_POST['user'])) {
                    UserController::view($_POST['user']);
                } elseif (isset($_POST['username'])) {
                    UserController::searchUser($_POST['username']);
                }
            ?>
            </table>
            
        </div>
        <div class="col-md-1">
           
        </div>
    </div>

</div>

<script>
    
</script>

<?php require_once 'layout/footer.php'; ?>