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

    public function getIsAvailableAttribute()
    {
        $last_update = $this->getLastStatusUpdate();

        if (! $last_update) {
            return false;
        }

        return $last_update->is_available;
    }

    public function getLastStatusUpdate()
    {
        return $this->status_updates()->orderBy('created_at', 'DESC')->first();
    }


    public function status_updates()
    {
        return $this->hasMany('App\StatusUpdate');
    }
}