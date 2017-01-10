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


namespace RoadBottle\Service;


use RoadBottle\Localisation;
use RoadBottle\Message;
use RoadBottle\Metier\MetierLocalisation;
use RoadBottle\Metier\MetierMessage;
use RoadBottle\Metier\MetierUtilisateur;
use RoadBottle\Utilisateur;

class ServiceUtilisateur
{
    /**
     * @var MetierUtilisateur
     */
    protected $metierUtilisateur;
    /**
     * @var MetierMessage
     */
    protected $metierMessage;
    /**
     * @var MetierLocalisation
     */
    protected $metierLocalisation;
    /**
     * @var Utilisateur
     */
    protected $utilisateur;

    /**
     * ServiceUtilisateur constructor.
     */
    public function __construct($id)
    {
        $this->metierUtilisateur = new MetierUtilisateur();
        $this->metierMessage = new MetierMessage();
        $this->metierLocalisation = new MetierLocalisation();

        if ($id instanceof Utilisateur) {
            $this->utilisateur = $id;
        } else {
            $this->utilisateur = $this->metierUtilisateur->getUtilisateurById($id);
        }

        if ($this->utilisateur == null) {
            throw new \Exception("L'utilisateur donnée en parametre n'existe pas");
        }
    }

    /**
     * Renvoie les messages créé par l'utilisateur
     * @return array
     */
    public function getCreatedMessages()
    {
        return $this->metierMessage->getMessagesByAuthor($this->utilisateur);
    }

    /**
     * Renvoie les messages que possède l'utilisateur actuellement
     * @return array
     */
    public function getOwnMessages()
    {
        return $this->metierMessage->getMessagesOwned($this->utilisateur);
    }

    /**
     * Crée un message en bdd et le renvoie
     * @param $message
     * @param $localisation Localisation
     * @return \RoadBottle\Message
     */
    public function createNewMessage($message, $lattitude, $longitude){
        $localisation = $this->metierLocalisation->create($lattitude, $longitude);
        return $this->metierMessage->createMessage($message, $this->utilisateur, $localisation);
    }

    /**
     * Laisse un message à terre
     * @param $idMessage int
     * @param $lattitude float
     * @param $longitude float
     */
    public function putMessage($idMessage, $lattitude, $longitude){
        $localisation = $this->metierLocalisation->create($lattitude, $longitude);
        $message = $this->metierMessage->getMessageById($idMessage);
        $this->metierMessage->putMessage($message, $localisation, $this->utilisateur);

    }
}