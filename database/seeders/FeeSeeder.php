<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('fees')->truncate();
    DB::table('fees')->insert(
            array(
                ['purpose'=> 'registration',
                'subject_id'=> NULL,
                'exam_type_id' => NULL,
                'amount' => '2750',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['purpose'=> 'exam',
                'subject_id'=> '1',
                'exam_type_id' => '1',
                'amount' => '2250',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['purpose'=> 'exam',
                'subject_id'=> '1',
                'exam_type_id' => '2',
                'amount' => '3250',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['purpose'=> 'exam',
                'subject_id'=> '2',
                'exam_type_id' => '1',
                'amount' => '2250',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['purpose'=> 'exam',
                'subject_id'=> '2',
                'exam_type_id' => '2',
                'amount' => '3250',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['purpose'=> 'exam',
                'subject_id'=> '3',
                'exam_type_id' => '1',
                'amount' => '2250',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
            )
        );
    }
}
