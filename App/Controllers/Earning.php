<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Earning as ModelsEarning;

class Earning extends Controller
{
    public function activatebpoint()
    {
        ModelsEarning::update(ModelsEarning::$table, "is_bpoint = 1", 'is_bpoint', 0);
        header('location:'.PREVIOUS_PAGE);
        return;
    }

    public function deactivatebpoint()
    {
        ModelsEarning::update(ModelsEarning::$table, "is_bpoint = 0", 'is_bpoint', 1);
        header('location:'.PREVIOUS_PAGE);
        return;
    }
}
