<?php
session_start();

spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $models = str_replace('\\', '/', $className).'.php';
    $controllers = str_replace('\\', '/', $className).'.php';
    $config = str_replace('\\', '/', $className).'.php';

    if (file_exists($models)) {
        require_once $models;
    } elseif (file_exists($controllers)) {
        require_once $controllers;
    } elseif (file_exists($config)) {
        require_once $config;
    }
}
