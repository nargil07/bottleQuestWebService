<?php

namespace RoadBottle;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Auteur(){
        return $this->belongsTo('RoadBottle\Utilisateur', 'utilisateur_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Owner(){
        return $this->belongsToMany('RoadBottle\Utilisateur', 'message_owners');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MessageOwners(){
        return $this->hasMany('RoadBottle\MessageOwner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Localisation()
    {
        return $this->belongsTo('RoadBottle\Localisation');
    }

}
