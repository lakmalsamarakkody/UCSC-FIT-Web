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
        DB::table('exams')->insert(
            array(
                [
                    'date' => '2020-10-30',
                    'subject_code' =>'IT103',
                    'subject_name' =>'ICT Applications',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-30',
                    'subject_code' =>'IT203',
                    'subject_name' =>'English for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-10-30',
                    'subject_code' =>'IT303',
                    'subject_name' =>'Mathematics for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_code' =>'IT103',
                    'subject_name' =>'ICT Applications',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_code' =>'IT203',
                    'subject_name' =>'English for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-11-30',
                    'subject_code' =>'IT303',
                    'subject_name' =>'Mathematics for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_code' =>'IT103',
                    'subject_name' =>'ICT Applications',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_code' =>'IT203',
                    'subject_name' =>'English for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2020-12-30',
                    'subject_code' =>'IT303',
                    'subject_name' =>'Mathematics for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_code' =>'IT103',
                    'subject_name' =>'ICT Applications',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_code' =>'IT203',
                    'subject_name' =>'English for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ],
                [
                    'date' => '2021-01-30',
                    'subject_code' =>'IT303',
                    'subject_name' =>'Mathematics for ICT',
                    'created_at' => '2020-11-27 17:36:23',
                    'updated_at' => '2020-11-27 17:36:23'
                ]
            )         
        );
    }
}
