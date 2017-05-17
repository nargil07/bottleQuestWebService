<?php

namespace RoadBottle\Http\Controllers;

use Illuminate\Http\Request;
use RoadBottle\Metier\MetierUtilisateur;
use RoadBottle\Utilisateur;

class UtilisateurController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        if($request->attributes->has('payload')){
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
        }

        return response()->json(false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function connexion(Request $request){
        if($request->has("email") && $request->has("password")){
            $metierUtilisateur = new MetierUtilisateur();
            $personne = $metierUtilisateur->connexion($request->email, $request->motdepasse);
            if(is_null($personne)){
                return response()->json(false);
            }else{
                return response()->json($personne);
            }
        }else{
            return response()->json(false);
        }
    }
}
