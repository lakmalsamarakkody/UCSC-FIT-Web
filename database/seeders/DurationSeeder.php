<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('exam_durations')->truncate();
        DB::table('exam_durations')->insert(
            array(
                ['subject_id'=> '1',
                'exam_type_id' => '1',
                'hours' => '2',
                'minutes' => '0',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),],
                ['subject_id'=> '1',
                'exam_type_id' => '2',
                'hours' => '2',
                'minutes' => '0',
                'minutes' => '0',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),],
                ['subject_id'=> '2',
                'exam_type_id' => '1',
                'hours' => '2',
                'minutes' => '0',
                'minutes' => '0',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),],
                ['subject_id'=> '2',
                'exam_type_id' => '2',
                'hours' => '2',
                'minutes' => '0',
                'minutes' => '0',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),],
                ['subject_id'=> '3',
                'exam_type_id' => '1',
                'hours' => '2',
                'minutes' => '0',
                'minutes' => '0',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),],
            )
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
