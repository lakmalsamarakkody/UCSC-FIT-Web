<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('permissions')->truncate();
    DB::table('permissions')->insert(
            array (
                [
                    'name'=>'student-dashboard',
                    'portal'=>'student',
                    'module'=>'dashboard',
                    'description'=>'Can view dashboard module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'student-information',
                    'portal'=>'student',
                    'module'=>'information',
                    'description'=>'Can view information module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'student-exam',
                    'portal'=>'student',
                    'module'=>'exam',
                    'description'=>'Can view exam module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'student-result',
                    'portal'=>'student',
                    'module'=>'result',
                    'description'=>'Can view result module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can view website module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can access to exam application page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-view',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view exam applications',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-payment-approve',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can approve an exam payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-payment-decline',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can decline an exam payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-viewSchedules',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view schedules for applied exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-scheduleExam',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can schedule an applied exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-application-approveSchedules',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can approve scheduled exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-medical',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can access to medical page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-medical-view',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-medical-approve',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can approve a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-exam-medical-decline',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can decline a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can access to system page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-permission',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view permissions',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-permission-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add a permission',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-permission-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit permission details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-permission-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete a permission',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-role',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view user roles',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-role-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add an user role',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-role-view',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view permissions of an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-role-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit permissions of an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-role-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete an user role',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-subject',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view subjects',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-subject-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add a subject',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-subject-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit subject details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-subject-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete a subject',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examType',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view exam types',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examType-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add an exam type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examType-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit exam type details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examType-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete an exam type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examDuration',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view exam durations',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examDuration-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add exam durations',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examDuration-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit exam durations',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-examDuration-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete exam durations',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-studentPhase',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view student phases',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-studentPhase-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add a student phase',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-studentPhase-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit student phase details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-studentPhase-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete a student phase',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentMethod',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view payment methods',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentMethod-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add a payment method',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentMethod-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit payment method details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentMethod-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete a payment method',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentType',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view payment types',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentType-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add a payment type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentType-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit payment type details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-paymentType-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete a payment type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can access to staff exam page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-add',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can add an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-edit',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can edit a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-delete-beforeRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can delete a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-request',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can request for exam schedule approval',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-approve',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can approve an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-decline',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can decline the approval of a exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-decline-message',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can view the exam schedule decline message',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-release',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can release an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-allRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can release all approved exam schedules',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-postpone',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can postpone a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-delete-afterRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can delete a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can access to exam list page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-add',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can add a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-viewResults',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can view results of a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-delete',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'Can delete a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
            )
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
