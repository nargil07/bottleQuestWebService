<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/{idUtilisateur}/message', ["uses"=>"MessageController@newMessage"]);
Route::get('/{idUtilisateur}/message', ["uses"=>"MessageController@getMessageOf"]);
Route::get('/{idUtilisateur}/ownMessage', ["uses"=>"MessageController@getOwnedMessage"]);
Route::get('/arrayMessage', function (){
    $messages = [];

    $message = new \RoadBottle\Message();
    $message->message = "Voila un message";
    $message->statut = \RoadBottle\Enum\EnumMessageStatut::POSSEDE;

});
