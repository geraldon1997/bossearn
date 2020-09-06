<?php
namespace App\Core;

use App\Core\Gateway;

class QueryBuilder extends Gateway
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway();
    }

    public function create()
    {
        //
    }

    public function insert()
    {
        //
    }

    public function update()
    {
        //
    }

    public function all()
    {
        //
    }

    public function find()
    {
        //
    }

    public function exists()
    {
        //
    }

    public function delete()
    {
        //
    }
}