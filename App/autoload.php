<?php
spl_autoload_register('loadClass');

function loadClass($className)
{
    $class = str_ireplace('\\', '/', $className).'.php';
    if (!file_exists($class)) {
        return false;
    }
    require_once $class;
}

define('HOME', '/');
define('HOW', '/page/how');
define('CONTACT', '/page/contact');