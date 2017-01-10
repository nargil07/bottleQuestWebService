<?php

use Illuminate\Database\Seeder;

class LocalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \RoadBottle\Localisation::create([
            "longitude" => 15.5646,
            "lattitude" => 42.5646,
        ]);
    }
}
