<?php
/**
 *
 * $Author$
 * $Rev$
 * $Date$
 * $Id$
 * $HeadURL$
 *
 * Copyright (c) C.I.S.S - Tous droits réservés
 *
 */


namespace RoadBottle\Metier;


use RoadBottle\Localisation;

class MetierLocalisation
{
    /**
     * Crée une localisation en base.
     * @param $lattitude string
     * @param $longitude string
     * @return Localisation
     */
    public function create($lattitude, $longitude){
        $localisation = new Localisation();
        $localisation->lattitude = $lattitude;
        $localisation->longitude = $longitude;
        $localisation->save();
        return $localisation;
    }

    public function getByIde($id){
        return Localisation::find($id);
    }
}