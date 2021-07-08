<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('labs')->truncate();
        DB::table('labs')->insert(
            array(
                ['name'=>'A',
                'capacity'=>15,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=>'B',
                'capacity'=>20,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=>'C',
                'capacity'=>15,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=>'D',
                'capacity'=>25,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=>'E',
                'capacity'=>10,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=>'F',
                'capacity'=>30,
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53']
            )
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
