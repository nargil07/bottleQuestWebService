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
Route::post ('/connexion',                              ["uses" => "UtilisateurController@connexion"]               );
Route::post ('/utilisateur',                            ["uses" => "UtilisateurController@register"]                );
Route::post ('/{idUtilisateur}/messages',               ["uses" => "MessageController@newMessage"]                  );
Route::get  ('/{idUtilisateur}/messages',               ["uses" => "MessageController@getMessageOf"]                );
Route::put  ('/{idUtilisateur}/messages/{idMessage}',   ["uses" => "MessageController@ramasserMessage"]             );
Route::get  ('/{idUtilisateur}/messages/proche',        ["uses" => "MessageController@getMessagesFromLocalisation"] );