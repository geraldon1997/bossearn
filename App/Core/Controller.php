<?php
namespace App\Core;

use App\Core\View;

class Controller
{
    public View $view;
    public $postData;
    public $getData;

    public function __construct()
    {
        $this->view = new View();
        if ($this->method() === 'post') {
            $this->postData = $_POST;
            $this->getData = $_GET;
        }
    }

    public function view($view, $params = null)
    {
        
        return $this->view->renderView($view, $params);
    }

    public function method()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        return strtolower($method);
    }
}