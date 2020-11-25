<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert(
            array(
                ['name'=> 'dinusha',
                'email'=>"kdd@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '2',
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['name'=> 'lakmal',
                'email'=>"sls@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '2',
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['name'=> 'dhananga',
                'email'=>"pdv@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '2',
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['name'=> 'yasindu',
                'email'=>"yde@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '2',
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['name'=> 'dr.thushani',
                'email'=>"taw@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '4',
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53']
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
        Schema::dropIfExists('users');
    }
}
