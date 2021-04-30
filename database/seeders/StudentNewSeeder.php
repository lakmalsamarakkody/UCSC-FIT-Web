<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Student\Flag;
use App\Models\Student\Payment;
use App\Models\Student\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0;$i<30;$i++):
            $f_name= $faker->firstName;
            $l_name=$faker->lastName;
            $m_names=$f_name." ".$l_name;
            $initials= $f_name[0]." ".$l_name[0];
            $full_name=$f_name." ".$m_names." ".$l_name;
            $gender=$faker->randomElement($array = array ('Male', 'Female'));
            $year=$faker->randomElement($array = array('2018','2019','2020','2021'));
            $month = $faker->numberBetween($min = 01, $max = 12);
            $date = $faker->numberBetween($min = 01, $max = 25);

            $student = new Student;
            $student->reg_no = 'F'. $year . $month. $date . $faker->unique()->numerify('###');
            $student->user_id = $i+3;
            $student->title = $faker->title($gender);
            $student->first_name = $f_name ;
            $student->middle_names = $m_names ;
            $student->last_name = $l_name ;
            $student->full_name = $full_name ;
            $student->initials = $initials ;
            $student->dob = $faker->dateTimeBetween('1980-01-01', '2000-12-31') ;
            $student->gender = $gender ;
            $student->citizenship = 'Sri Lankan' ;
            $student->nic_old = $faker->unique()->numerify('#########').'V' ;
            $student->education = $faker->randomElement($array = array ('Bachelor\'s Degree' ,'GCE Advanced Level', 'GCE Ordinary Level')) ;
            $student->permanent_house = 'No: '.$faker->buildingNumber ;
            $student->permanent_address_line1 =  $faker->streetName;
            $student->permanent_city_id = $faker->numberBetween($min = 1, $max = 1845) ;
            $student->permanent_country_id = 67 ;
            $student->telephone = $faker->unique()->numerify('#########') ;
            $student->designation =  $faker->jobTitle;
            $student->reg_year =  $year;
            
            $student->save();
            $student_id = $student->id;

            $payment = new Payment;
            $payment->student_id = $student_id;
            $payment->method_id = 2;
            $payment->type_id = 1;
            $payment->amount =  2750.00;
            $payment->bank_id = 1;
            $payment->bank_branch_id = 285;
            $payment->paid_date = date('Y-m-d');
            $payment->image = '1_2021-04-21_1618999286.png';
            $payment->status = 'Approved';

            $payment->save();

            
            $registration = new Registration;
            $registration->student_id = $student_id;
            $registration->registered_at = date('Y-m-d');
            $registration->registration_expire_at = date('Y-m-d', strtotime($registration->registered_at. ' + 365 days'));
            $registration->application_submit = 1;
            $registration->application_status = 'Approved';
            $registration->document_submit = 1;
            $registration->document_status = 'Approved';
            $registration->payment_id =  $payment->id;
            $registration->payment_status = $payment->status;
            $registration->status = 1;

            $registration->save();

            $flag = new Flag;
            $flag->student_id = $student_id;
            $flag->info_complete = 1;
            $flag->info_editable = 0;
            $flag->declaration = 1;
            $flag->bit_eligible = 0;
            $flag->fit_cert = 0;
            $flag->phase_id = 1;
            $flag->enrollment = 'new';

            $flag->save();

        endfor;
    }
}
