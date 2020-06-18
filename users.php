<?php

use App\Controllers\UserController;

require_once 'layout/header.php';
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

    }
    @media (max-width: 700px){
        button{
            margin-bottom: 10px;
        }
    }
</style>

<div class="page-wrapper text-center">

    <div class="row">
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="user" value="3">
                <button type="submit" class="btn">users</button>
            </form>
        </div>
        
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="user" value="2">
                <button type="submit" class="btn">vendors</button>
            </form>
        </div>
    </div>

<hr>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
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
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    UserController::view($_POST['user']);
                }
            ?>
            </table>
            
        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<?php require_once 'layout/footer.php'; ?>