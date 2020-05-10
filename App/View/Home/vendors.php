<?php
use App\Core\Layout;
use App\Controller\UserController;

$uc = new UserController;

require_once Layout::start('home.header');
?>
<hr><hr><hr>
<h1>vendors</h1>

<?php require_once Layout::end('home.footer'); ?>