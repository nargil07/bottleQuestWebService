<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post ('/utilisateur',                            ["uses" => "UtilisateurController@register"]                );
Route::get  ('/utilisateur/{idUtilisateur}',            ["uses" => "UtilisateurController@get"]                     );
Route::post ('/{idUtilisateur}/messages',               ["uses" => "MessagesController@newMessage"]                 );
Route::get  ('/{idUtilisateur}/messages',               ["uses" => "MessagesController@getMessagesFromUser"]        );
Route::put  ('/{idUtilisateur}/messages/{idMessage}',   ["uses" => "MessagesController@ramasserMessage"]            );
Route::get  ('/{idUtilisateur}/messages/proche',        ["uses" => "MessagesController@getMessagesFromLocalisation"]);