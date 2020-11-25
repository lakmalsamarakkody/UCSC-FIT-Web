<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('roles')->insert(
            array(
                ['name'=> 'Student',
                'description'=> 'FIT Student',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Super Administrator',
                'description'=> 'Full System Administrator',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Administrator',
                'description'=> 'System Administrator',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Co-Ordinator',
                'description'=> 'FIT Co-Ordinator',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Assistent Registar',
                'description'=> 'eLC - UCSC',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
