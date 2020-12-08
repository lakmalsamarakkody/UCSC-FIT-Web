<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker=\Faker\Factory::create();
          
      for ($i=0; $i < 20; $i++):
        $Sid = $faker->numberBetween($min = 1, $max = 3);
        if( $Sid == 3):
          $Etid = 1;
        else:
          $Etid = $faker->numberBetween($min = 1, $max = 2);
        endif;
        DB::table('exam_schedules')->insert(
          array( 
              [
                'exam_id' => $faker->numberBetween($min = 1, $max = 10),
                'subject_id' =>$Sid,
                'exam_type_id' => $Etid,
                'date' => $faker->dateTimeBetween('2020-01-01', '2020-12-31'),
                'start_time' => $faker->time(),
                'end_time' => $faker->time(),
                'created_at' => '2020-11-27 17:36:23',
                'updated_at' => '2020-11-27 17:36:23'
              ]
          )         
      );
      endfor;
    }
}
