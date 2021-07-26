<?php

namespace Database\Seeders;

use App\Models\Exam;
use Facade\FlareClient\Time\Time;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Editor\Fields\Boolean;

class ExamScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('exam_schedules')->truncate();

      $faker=\Faker\Factory::create();
      $exam_ids=Exam::all();
      foreach ($exam_ids as $exam_id):                     
        for ($i=0; $i < 5; $i++):   
          if($i<2):
            $Sid=1;
            $Etid=$i+1;            
          elseif($i<4):
            $Sid=2;
            $Etid=$i-1;
          else:
            $Sid=3;
            $Etid = 1;
          endif;

          DB::table('exam_schedules')->insert(
            array( 
                [
                  'exam_id' => $exam_id->id,
                  'subject_id' =>$Sid,
                  'exam_type_id' => $Etid,
                  'lab'=>$faker->randomElement($array = array('A', 'B', 'C', 'D', 'E', 'F')),
                  'lab_capacity'=>$faker->randomElement($array = array(10,15,20,25,30)),
                  'date' => $faker->dateTimeBetween($exam_id->year .'-'. $exam_id->month.'-01', '2022-12-31'),
                  'start_time' => $faker->time($format = 'H:i'),
                  'end_time' => Carbon::now()->addHours(rand(1,8)),
                  'created_at' => '2020-11-27 17:36:23',
                  'updated_at' => '2020-11-27 17:36:23'
                ]
            )         
          );
        endfor;
      endforeach;
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
