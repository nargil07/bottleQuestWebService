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


namespace RoadBottle\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RoadBottle\Service\ServiceUtilisateur;

class MessageController extends Controller
{

    public function newMessage($idUtilisateur, Request $request){
        try{
            $serviceUtilisateur = new ServiceUtilisateur($idUtilisateur);
            $serviceUtilisateur->createNewMessage($request->message, $request->lattitude, $request->longitude);
        }catch (\Exception $e){
            return response()->json(["erreur" => $e->getMessage()]);
        }
        return response()->json(true);

    }

    public function getMessageOf($idUtilisateur){
        $serviceUtilisateur = new ServiceUtilisateur($idUtilisateur);
        return response()->json($serviceUtilisateur->getCreatedMessages());
    }

    public function getOwnedMessage($idUtilisateur){
        $serviceUtilisateur = new ServiceUtilisateur($idUtilisateur);
        return response()->json($serviceUtilisateur->getOwnMessages());
    }
}