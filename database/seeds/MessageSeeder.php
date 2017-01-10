<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];

        for($i = 0; $i < 20 ; $i++){
            $message = new \RoadBottle\Message();
            $message->message = str_random(32);
            $message->statut = \RoadBottle\Enum\EnumMessageStatut::POSSEDE;
            $message->utilisateur_id = 1;
            $message->localisation_id = 1;
            $message->save();

            $messageOwner = new \RoadBottle\MessageOwner();
            $messageOwner->Message()->associate($message);
            $messageOwner->utilisateur_id = 1;
            $messageOwner->dateDebut = \Carbon\Carbon::now();
            $messageOwner->localisation_id_debut = 1;
            $messageOwner->save();
        }
    }
}
