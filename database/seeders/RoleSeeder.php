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
}
