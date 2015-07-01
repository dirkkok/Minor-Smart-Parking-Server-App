<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    protected $table = 'status_updates';
    protected $fillable = ['sensor_id', 'is_available'];

    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
}