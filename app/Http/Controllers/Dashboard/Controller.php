<?php namespace App\Http\Controllers\Dashboard;

use App\Sensor;
use App\StatusUpdate;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $sensors = Sensor::all();

        return view('dashboard', compact('sensors'));
    }
}
