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
    /**
     * @param $id
     * @return mixed
     */
    public function getUtilisateurById($id){
        return Utilisateur::find($id);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUtilisateurByEmail($email){
        return Utilisateur::where('email', '=', $email)->get()->first();
    }

    /**
     * @param $email
     * @param $motdepasse
     * @return mixed
     */
    public function connexion($email, $motdepasse){
        $utilisateur = Utilisateur::where('email', $email)->where('motdepasse', $motdepasse)->get()->first();
        return $utilisateur;
    }

    /**
     * @param $nom
     * @param $prenom
     * @param $login
     */
    public function create($nom, $prenom, $mail, $picture){
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $nom;
        $utilisateur->prenom = $prenom;
        $utilisateur->email = $mail;
        $utilisateur->picture = $picture;
        $utilisateur->save();
    }
}