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
        DB::table('exams')->insert(
            array(
                [
                    'date' => '2020-10-30',
                    'subject_id' =>'1',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-31',
                    'subject_id' =>'1',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '2',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-30',
                    'subject_id' =>'2',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-31',
                    'subject_id' =>'2',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '2',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-30',
                    'subject_id' =>'3',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_id' =>'1',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_id' =>'2',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_id' =>'3',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_id' =>'1',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_id' =>'2',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_id' =>'3',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_id' =>'1',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_id' =>'2',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_id' =>'3',
                    'start_time' => $faker->time(),
                    'end_time' => $faker->time(),
                    'exam_type_id' => '1',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ]
            )         
        );
    }
}
