<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('sl_cities', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('district_id');
        //     $table->string('name');
        //     $table->string('name_si')->nullable();
        //     $table->string('name_ta')->nullable();
        //     $table->string('sub_name')->nullable();
        //     $table->string('sub_name_si')->nullable();
        //     $table->string('sub_name_ta')->nullable();             
        //     $table->string('postcode')->nullable();
        //     $table->double('latitude',20,10)->nullable();
        //     $table->double('longitude',20,10)->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('sl_cities');
    }
}
