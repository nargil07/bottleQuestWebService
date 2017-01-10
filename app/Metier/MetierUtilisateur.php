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

use RoadBottle\Utilisateur;

/**
 * Class MetierUtilisateur
 * @package RoadBottle\Metier
 */
class MetierUtilisateur
{
    public function getUtilisateurById($id){
        return Utilisateur::find($id);
    }

    public function create($nom, $prenom, $login){
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->login = $login;
        $utilisateur->save();
    }
}