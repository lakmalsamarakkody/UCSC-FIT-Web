<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('exams')->truncate();

      $faker=\Faker\Factory::create();
      for($i=0;$i<20;$i++):
        $year=$faker->numberBetween($min = 2019, $max = 2021);
        DB::table('exams')->insert(
            array (
                [
                    'year'=>$year,
                    'month'=>$faker->numberBetween($min = 1, $max = 12),
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ]
                
            )
        );
      endfor;

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
