<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('utilisateur_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs');
            $table->foreign('message_id')->references('id')->on('messages');
            $table->dateTime('datedebut');
            $table->dateTime('datefin')->nullable();
            $table->integer('localisation_id_debut');
            $table->integer('localisation_id_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_owners');
    }
}
