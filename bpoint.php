<?php

use App\Controllers\EarningController;
use App\Models\Earning;

require_once 'layout/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Earning::paid($_POST['type'], $_POST['uid']);
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
    }
    @media (max-width: 700px){
        button{
            margin-bottom: 10px;
        }
    }
</style>

<div class="page-wrapper">
    <h1>Bpoint Earnings</h1>
    <div class="row">
        
        <div class="col-md-12 tbl">
            <table border="1">
                <th>S/N</th>
                <th>Email</th>
                <th>Bank</th>
                <th>Account Name</th>
                <th>Account number</th>
                <th>points</th>
                <th>Naira (cash)</th>
                <th>action</th>
                <?php EarningController::view('bearn'); ?>
            </table>
        </div>
        
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>