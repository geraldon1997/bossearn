<?php
$time = $_GET['expire'];

if ($time < time()) {
    echo 'verification link has expired';
} else {
    echo "verified";
}
