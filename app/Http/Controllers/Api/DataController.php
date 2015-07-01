<?php namespace App\Http\Controllers\Api;

use App\Sensor;
use App\StatusUpdate;
use Laravel\Lumen\Routing\Controller as BaseController;

class DataController extends BaseController
{
    public function status($status, $sensor_id)
    {
        $sensor = Sensor::find($sensor_id);

        if (! $sensor or ($status != 'false' and $status != 'true')) {
            return ['success' => false];
        }

        $status_update = StatusUpdate::create(['sensor_id' => $sensor->id, 'is_available' => $status == 'true' ? true : false]);

        return ['success' => true];
    }
}
