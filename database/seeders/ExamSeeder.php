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
      $faker=\Faker\Factory::create();
      for($i=0;$i<20;$i++):
        $year=0;
        while($year<2017):
            $year=$faker->year();
        endwhile;
        DB::table('exams')->insert(
            array (
                [
                    'year'=>$year,
                    'month'=>$faker->randomElement($array = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')),
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ]
                
            )
        );
      endfor;
    }
}
