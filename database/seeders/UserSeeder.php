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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        DB::table('users')->insert(
            array(
                ['name'=> 'dinusha',
                'email'=>"kdd@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '1',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['name'=> 'lakmal',
                'email'=>"sls@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '1',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['name'=> 'dhananga',
                'email'=>"pdv@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '6',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                // ['name'=> 'yasindu',
                // 'email'=>"yde@ucsc.cmb.ac.lk",
                // 'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                // 'role_id'=> '1',
                // 'status'=> true,
                // 'created_at'=> '2020-11-23 10:13:53',
                // 'updated_at'=> '2020-11-23 10:13:53'],
                
                ['name'=> 'dr.thushani',
                'email'=>"taw@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '4',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                // ['name'=> 'Super Admin',
                // 'email'=>"fit.ucsc.cmb.ac.lk@gmail.com",
                // 'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                // 'role_id'=> '2',
                // 'status'=> true,
                // 'created_at'=> '2020-11-23 10:13:53',
                // 'updated_at'=> '2020-11-23 10:13:53'],

                ['name'=> 'elc',
                'email'=>"elc@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '2',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['name'=> 'admin',
                'email'=>"admin@ucsc.cmb.ac.lk",
                'password'=>'$2y$10$chLDig2zqSahPLNRnur.0O3xzyvjlzH54Jwsp.gblzj3Ltp.dfxkG',
                'role_id'=> '3',
                'status'=> true,
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
