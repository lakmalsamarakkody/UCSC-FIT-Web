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
                    'name'=>'staff-system',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can access to system page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-role',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view user roles',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-role-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add an user role',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-role-view',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view permissions of an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-role-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit permissions of an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-role-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete an user role',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-permission',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view permissions',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-permission-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add a permission',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-permission-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit permission details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-permission-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete a permission',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-subject',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view subjects',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-subject-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add a subject',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-subject-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit subject details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-subject-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete a subject',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-examType',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view exam types',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-examType-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add an exam type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-examType-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit exam type details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-examType-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete an exam type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-studentPhase',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view student phases',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-studentPhase-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add a student phase',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-studentPhase-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit student phase details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-studentPhase-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete a student phase',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentMethod',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view payment methods',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentMethod-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add a payment method',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentMethod-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit payment method details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentMethod-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete a payment method',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentType',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can view payment types',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentType-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can add a payment type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentType-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can edit payment type details',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-system-paymentType-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'can delete a payment type',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can access to staff exam page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-add',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can add an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-edit',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can edit a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-delete-beforeRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can delete a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-request',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can request for exam schedule approval',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-approve',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can approve an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-decline',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can decline the approval of a exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-decline-message',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can view the exam schedule decline message',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-release',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can release an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-allRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can release all approved exam schedules',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-postpone',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can postpone a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'staff-exam-schedule-delete-afterRelease',
                    'portal'=>'staff',
                    'module'=>'exams',
                    'description'=>'can delete a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
            )
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
