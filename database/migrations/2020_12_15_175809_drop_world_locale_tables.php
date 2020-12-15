<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWorldLocaleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('world_cities_locale');
        Schema::dropIfExists('world_divisions_locale');
        Schema::dropIfExists('world_countries_locale');
        Schema::dropIfExists('world_continents_locale');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('world_continents_locale');
        Schema::dropIfExists('world_countries_locale');
        Schema::dropIfExists('world_divisions_locale');
        Schema::dropIfExists('world_cities_locale');
    }
}
