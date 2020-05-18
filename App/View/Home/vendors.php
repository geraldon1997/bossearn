<?php
use App\Core\Layout;
use App\Controller\UserController;

require_once Layout::start('home.header');
?>
<style>
    .content{
    width: 100%;
    margin: 0 auto;
    margin-top: 100px;
    margin-bottom: 200px;
    text-align: center;
    height: auto;
    color: black;
}
table{
    width: auto;
    margin: 0 auto;
    text-transform: capitalize;
}
th{
    padding: 10px;
}
td{
    padding: 10px;
}
</style>
<div class="content">
<h1>Vendors</h1>

<table border="1">
    <th>first name</th>
    <th>last name</th>
    <th>email</th>
    <th>phone</th>
    <th>username</th>

<?php UserController::viewVendors(); ?>
</table>
</div>

<?php require_once Layout::end('home.footer'); ?>