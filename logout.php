<?php
session_start();
session_unset();

echo "<script>window.location = 'login.php';</script>";
