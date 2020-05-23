<?php
spl_autoload_register('myAutoLoad');

function myAutoLoad($class)
{
    $newClass = str_replace('\\', '/', $class);
    $ext = '.php';
    $className = $newClass.$ext;

    if (file_exists($className)) {
        require_once $className;
    }
}
