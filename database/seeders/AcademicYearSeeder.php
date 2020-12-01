<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_years')->insert(
            array(
                ['year'=> '2017',
                'start'=> '2017-01-01',
                'end'=>"2017-12-31",
                'created_at'=> '2020-12-01 10:13:53',
                'updated_at'=> '2020-12-01 10:13:53'],

                ['year'=> '2018',
                'start'=> '2018-01-01',
                'end'=>"2018-12-31",
                'created_at'=> '2020-12-01 10:13:53',
                'updated_at'=> '2020-12-01 10:13:53'],

                ['year'=> '2019',
                'start'=> '2019-01-01',
                'end'=>"2019-12-31",
                'created_at'=> '2020-12-01 10:13:53',
                'updated_at'=> '2020-12-01 10:13:53'],

                ['year'=> '2020',
                'start'=> '2020-01-01',
                'end'=>"2020-12-31",
                'created_at'=> '2020-12-01 10:13:53',
                'updated_at'=> '2020-12-01 10:13:53'],

                ['year'=> '2021',
                'start'=> '2021-01-01',
                'end'=>"2021-12-31",
                'created_at'=> '2020-12-01 10:13:53',
                'updated_at'=> '2020-12-01 10:13:53'],
            )
        );
    }
}
