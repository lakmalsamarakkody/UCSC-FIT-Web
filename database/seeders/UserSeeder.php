<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
