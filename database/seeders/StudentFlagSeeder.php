<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $students=Student::all();
        foreach($students as $student):
            DB::table('student_flags')->insert(
                array(
                    [
                        'id'=>$student->id,
                        'birth_cert'=>false,
                        'nic_img'=>false,
                        'postal_img'=>false,
                        'bit_eligible'=>false,
                        'fit_cert'=>false,
                        'phase_id'=>false,
                    ]
                )
            );
        endforeach;
    }
}
