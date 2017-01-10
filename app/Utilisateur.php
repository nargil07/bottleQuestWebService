<?php

namespace RoadBottle;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public function Messages(){
        return $this->belongsToMany('RoadBottle\Message','message_owners');
    }

    public function MessagesCree(){
        return $this->hasMany('RoadBottle\Message');
    }
}
