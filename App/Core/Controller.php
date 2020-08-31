<?php
namespace App\Core;

use App\Core\View;
use App\Models\Role;
use App\Models\User;

class Controller
{
    public View $view;
    public $postData;
    public $getData;
    public $error;
    public $pages = [
        'auth' => [
            'admin' => [
                'coupons',
                'users',
                'home',
                'how',
                'contact',
                'login',
                'register'
            ],
            'vendor' => [
                'home',
                'how',
                'contact',
                'login',
                'register'
            ],
            'user' => [
                'sponsored',
                'profile',
                'home',
                'how',
                'contact',
                'login',
                'register'
            ]
        ],
        'nonauth' => [
            'home',
            'how',
            'contact',
            'login',
            'register'
        ]
    ];

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

        if (isset($_SESSION['uname'])) {
            $role = Role::role();
            $page = array_search($view, $this->pages['auth'][$role]);
            return $this->view->renderView($this->pages['auth'][$role][$page], $params);
        }

        $page = array_search($view, $this->pages['nonauth']);
        return $this->view->renderView($this->pages['nonauth'][$page], $params);
    }

    public function method()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        return strtolower($method);
    }

    public function validateForm()
    {
        foreach ($this->postData as $key => $value) {
            if (empty($this->postData[$key])) {
                $this->error[$key] = "$key cannot be empty";
            }
            htmlspecialchars($this->postData[$key]);
        }
    }

    public function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}