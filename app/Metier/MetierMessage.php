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


use Carbon\Carbon;
use RoadBottle\Enum\EnumMessageStatut;
use RoadBottle\Localisation;
use RoadBottle\Message;
use RoadBottle\MessageOwner;
use RoadBottle\Utilisateur;

/**
 * Class MetierMessage
 * @package RoadBottle\Metier
 */
class MetierMessage
{
    /**
     * @param $id int
     * @return Message
     */
    public function getMessageById($id){
        return Message::find($id);
    }

    /**
     * @param Utilisateur $utilisateur
     * @return array
     */
    public function getMessagesByAuthor(Utilisateur $utilisateur){
        return $utilisateur->MessagesCree()->with('Localisation')->get()->all();
    }

    /**
     * @param Utilisateur $utilisateur
     * @return array
     */
    public function getMessagesOwned(Utilisateur $utilisateur){
        return $utilisateur->Messages()->with('Localisation')
            ->withPivot(['dateDebut', 'dateFin'])->wherePivot('dateFin', "=", null)->get()->all();
    }

    /** Récupère le MessageOwner du message qui est possèdé par quelqu'un.
     * @param Message $message
     * @return MessageOwner
     */
    private function getPivotFromMessage(Message $message){
        return $message->MessageOwners()->where('dateFin', '=', null)->get()->first();
    }

    /**
     * @param Utilisateur $utilisateur
     * @return array
     */
    public function getMessagesHistory(Utilisateur $utilisateur){
        return $utilisateur->Messages;
    }

    /**
     * Crée un message qui sera possède par l'utilisateur passé en parametre
     * @param $message
     * @param Utilisateur $utilisateur
     * @return Message
     */
    public function createMessage($message, Utilisateur $utilisateur, Localisation $localisation){
        $messageToSave = new Message();
        $messageToSave->message = $message;
        $messageToSave->statut = EnumMessageStatut::POSSEDE;
        $messageToSave->Auteur()->associate($utilisateur);
        $messageToSave->save();
        $this->createMessageOwner($messageToSave, $utilisateur, $localisation);
        return $messageToSave;
    }

    public function putMessage(Message $message, Localisation $localisation, Utilisateur $utilisateur){
        $messageOwner = $this->getPivotFromMessage($message);
        $messageOwner->dateFin = Carbon::now();
        $messageOwner->LocalisationFin()->associate($localisation);
        $message->Localisation()->associate($localisation);
        $message->statut = EnumMessageStatut::POSE;
        $messageOwner->save();
        $message->save();
    }

    /**
     * Crée la liaison entre message et owner.
     * @param Message $message
     * @param Utilisateur $user
     * @param Localisation $localisation
     */
    private function createMessageOwner(Message $message, Utilisateur $user, Localisation $localisation){
        $messageOwner = new MessageOwner();
        $messageOwner->Message()->associate($message);
        $messageOwner->Utilisateur()->associate($user);
        $messageOwner->dateDebut = Carbon::now();
        $messageOwner->LocalisationDebut()->associate($localisation);
        $messageOwner->save();
    }

    public function getAll(){
        $messages = Message::where('statut', EnumMessageStatut::POSE)->get()->all();
        return $messages;
    }
}