<?php

namespace RoadBottle;

use Illuminate\Database\Eloquent\Model;

class MessageOwner extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Utilisateur(){
        return $this->belongsTo('RoadBottle\Utilisateur');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Message(){
        return $this->belongsTo('RoadBottle\Message');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function LocalisationDebut(){
        return $this->belongsTo('RoadBottle\Localisation', 'localisation_id_debut');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function LocalisationFin(){
        return $this->belongsTo('RoadBottle\Localisation', 'localisation_id_fin');
    }
}
