<?php

use App\Controllers\EarningController;

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

<div class="page-wrapper">
    <h1>Earnings</h1>
    <div class="row">
        
        <div class="col-md-12 tbl">
            <table border="1">
                <th>S/N</th>
                <th>Email</th>
                <th>Bank</th>
                <th>Account Name</th>
                <th>Account number</th>
                <th>Bref</th>
                <th>Bpoints</th>
                <th>withdraw type</th>
                <th>withdraw (cash)</th>
                <th>action</th>
                <?php EarningController::view(); ?>
            </table>
        </div>
        
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>