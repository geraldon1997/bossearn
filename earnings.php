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
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table border="1">
                <th>S/N</th>
                <th>Email</th>
                <th>Bref</th>
                <th>Bearn</th>
                <th>total</th>
                <th>total (currency)</th>
                <th>action</th>
                <?php EarningController::view(); ?>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>