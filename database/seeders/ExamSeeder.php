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
        for ($i=5; $i>=0;$i--){

            DB::table('exams')->insert([
                'date' => Carbon::create('2000', '01', '01'),
                'subject_code' =>Str::random(4),
                'subject_name' =>Str::random(10),
            ]);
        }
    }
}
