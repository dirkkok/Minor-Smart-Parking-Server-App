<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sensors';


    public function status_updates()
    {
        return $this->hasMany('App\StatusUpdate');
    }
}