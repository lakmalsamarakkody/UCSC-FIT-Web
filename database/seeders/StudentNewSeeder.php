<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Student\Flag;
use App\Models\Student\hasExam;
use App\Models\Student\Payment;
use App\Models\Student\Registration;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            $initials= $f_name[0].$l_name[0];
            $full_name=$f_name." ".$l_name;
            $gender=$faker->randomElement($array = array ('Male', 'Female'));
            $year=$faker->randomElement($array = array('18','19','20','21'));
            $month = $faker->randomElement($array = array('01','02','03','04','05','06','07','08','09','10','11','12'));
            $date = $faker->randomElement($array = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26'));


            $user = new User;
            $user->name = $f_name;
            $user->email = $faker->unique()->email;
            $user->password = '$2y$10$gKEmkTJrrLuyUXV1LLl5tuCnWWSR6srMlt9fedxrpywOL3xf8PMW6';
            $user->role_id = 1;
            $user->status = 1;
            $user->profile_pic = '6_profile_pic_2021-01-15_1610687576.png';

 

            $user->save();   
           
            $token = Str::random(32);
            $subscriber = new Subscriber();
            $subscriber->email = $user->email;
            $subscriber->token = $token;

            
            $subscriber->save();



            $student = new Student;
            $student->reg_no = 'F'. $year . $month. $date . $faker->unique()->numerify('###');
            $student->user_id = $user->id;
            $student->title = $faker->title($gender);
            $student->first_name = $f_name ;
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


            $examPayment = new Payment;
            $examPayment->student_id = $student_id;
            $examPayment->method_id = 2;
            $examPayment->type_id = 2;
            $examPayment->amount = 6750.00;
            $examPayment->bank_id = 1;
            $examPayment->bank_branch_id = 205;
            $examPayment->paid_date = '2021-07-05';
            $examPayment->image = '5_2021-07-12_1626073593.jpg';

            $examPayment->save();

            for ($j = $faker->numberBetween($min = 1, $max = 3) ; $j > 0 ; $j--):    
                $hasExam = new hasExam;
                $hasExam->student_id = $student_id;
                $hasExam->subject_id = $j;
                $hasExam->exam_type_id = 1;
                $hasExam->requested_exam_id = 2;
                $hasExam->payment_id = $examPayment->id;
                $hasExam->schedule_status = 'Pending';

                $hasExam->save();
            endfor;

        endfor;
    }
}
