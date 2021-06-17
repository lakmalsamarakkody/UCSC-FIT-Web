<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('roles')->truncate();
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

                ['name'=> 'Director',
                'description'=> 'UCSC Director',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],


                ['name'=> 'Coordinator',
                'description'=> 'FIT Coordinator',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Assistant Registrar',
                'description'=> 'eLC - UCSC',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['name'=> 'Management Assistant',
                'description'=> 'FIT Management Assistant',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
