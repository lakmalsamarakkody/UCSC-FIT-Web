<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        DB::table('users')->insert(
            array(
                ['created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53',
                'name'=> 'dinusha',
                'email'=>"kdd@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG'],

                
                ['created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53',
                'name'=> 'lakmal',
                'email'=>"sls@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG'],

                ['created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53',
                'name'=> 'dhananga',
                'email'=>"pdv@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG'],

                ['created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53',
                'name'=> 'yasindu',
                'email'=>"yde@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG'],
                
                ['created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53',
                'name'=> 'dr.thushani',
                'email'=>"taw@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG']

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
