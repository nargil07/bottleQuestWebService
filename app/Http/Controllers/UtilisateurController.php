<?php

namespace RoadBottle\Http\Controllers;

use Illuminate\Http\Request;
use RoadBottle\Metier\MetierUtilisateur;
use RoadBottle\Utilisateur;

class UtilisateurController extends Controller
{
    public function register(Request $request)
    {
        $payload = $request->attributes->get('payload');
        if(!is_null($payload)){
            $metierUtilisateur = new MetierUtilisateur();
            $personne = $metierUtilisateur->getUtilisateurByEmail($payload['email']);
            if(is_null($personne)){
                $personne = new Utilisateur();
                $personne->nom = $payload['family_name'];
                $personne->prenom = $payload['given_name'];
                $personne->email = $payload['email'];
                $personne->picture = $payload['picture'];
                return response()->json($personne->save());
            }
            return response()->json(true);
        }
        return response()->json(false);
    }
}
