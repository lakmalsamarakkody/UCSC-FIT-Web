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
                // STUDENT PORTAL
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
                    'name'=>'student-exam-apply-exams',
                    'portal'=>'student',
                    'module'=>'exam',
                    'description'=>'Can apply for exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'student-exam-pay-exams',
                    'portal'=>'student',
                    'module'=>'exam',
                    'description'=>'Can pay for applied exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'student-exam-medical',
                    'portal'=>'student',
                    'module'=>'exam',
                    'description'=>'Can view medical section in held exams',
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
                // / STUDENT PORTAL

                // STAFF PORTAL
                // STAFF->DASHBOARD
                [
                    'name'=>'staff-dashboard',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can view dashboard module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // STAFF->DASHBOARD->REGISTRATIONS
                [
                    'name'=>'staff-dashboard-registration-application-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration application page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-application-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve a registration application',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-application-decline',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline a registration application',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-payment-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration payment review page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-payment-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve a registration payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-payment-decline',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline a registration payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-pending-documents-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration pending documents page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-documents-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration review documents page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-documents-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve registration documents',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-documents-decline-birth',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline registration birth certificate',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-review-documents-decline-id',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline registration identity verification',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-pending-registrations-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration pending registrations page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-pending-registrations-register',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can register a student',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-registration-active-registrations-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to registration active registrations page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // STAFF->DASHBOARD->EXAMS
                [
                    'name'=>'staff-dashboard-exam-review-payments-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to exam review payments page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-assign-schedules-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to exam assign schedules page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-review-medicals-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to exam review medicals page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-reschedule-exams-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can access to exam reschedule page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can view exam applications',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-payment-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve an exam payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-payment-decline',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline an exam payment',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-viewSchedules',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can view schedules of selected exam list',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-scheduleExam',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can set a schedule for a applied exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-application-approveSchedules',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve assigned scheduled exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-review-medical-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can view a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-review-medical-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-review-medical-decline',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline a medical',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-reschedule-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can reschedule an exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-exam-review-reschedule-requests-view',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can view reschedule requests',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-reschedule-request-payment-approve',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can approve a reschedule request',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-dashboard-reschedule-request-payment-decline',
                    'portal'=>'staff',
                    'module'=>'dashboard',
                    'description'=>'Can decline a reschedule request',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->DASHBOARD

                // STAFF->STUDENTS
                [
                    'name'=>'staff-student',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view student module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view a student profile',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-update-info',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can update student information',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-update-registration',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can update student current registration',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-downloadStdList',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can download student lists',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-email-reset',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can reset a student email',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-block',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can hold/unhold a student activities',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-account',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can activate/deactivate a student account',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-result-view',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view student results',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-payment-view',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view student payments',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-student-profile-medical-view',
                    'portal'=>'staff',
                    'module'=>'student',
                    'description'=>'Can view student medicals',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->STUDENTS

                // STAFF->EXAM
                [
                    'name'=>'staff-exam',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view exam module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-drafted-view',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-scheduled-view',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view scheduled exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-held-view',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view held exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-add',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can add an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-edit',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can edit a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-delete-beforeRelease',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can delete a drafted exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-request',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can request for exam schedule approval',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-approve',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can approve an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-decline',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can decline the approval of a exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-decline-message',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view the exam schedule decline message',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-release',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can release an exam schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-allRelease',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can release all approved exam schedules',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-view-students',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view all assign students for a schedule',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-student-deschedule',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can deschedule an assigned student',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-postpone',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can postpone a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-schedule-delete-afterRelease',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can delete a scheduled exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can access to exam list page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-add',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can add an exam to exam list',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-downloadStdList',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can download student list of an exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-viewResults',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can view results of a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examList-delete',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can delete a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examAssign',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can access to assign exam page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-exam-examAssign-assign',
                    'portal'=>'staff',
                    'module'=>'exam',
                    'description'=>'Can assign students for an exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->EXAMS

                // STAFF->RESULTS
                [
                    'name'=>'staff-result',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can view result module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-import',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can import result from VLE exported file',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-view',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can view results',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-view-pending',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can view pending result exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-hold',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can hold results',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-release',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can release results',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-view-pushResults',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can push results of a exam',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-result-view-marks',
                    'portal'=>'staff',
                    'module'=>'result',
                    'description'=>'Can view marks of a student',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->RESULTS

                // STAFF->USERS
                [
                    'name'=>'staff-user',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can view user module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-add',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can invite an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-permissions',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can change user permissions',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-permissions-superadmin',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can change super admin permissions',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-permissions-admin',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can change admin permissions',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-view',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can view user profile',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-chnageUserRole',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can change user role',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-resetEmail',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can reset user email',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-activate',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can activate a user account',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-deactivate',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can deactivate a user account',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-user-profile-closeToReReg',
                    'portal'=>'staff',
                    'module'=>'user',
                    'description'=>'Can close a user account to allow re-register as a new student',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->USERS

                // STAFF->WEBSITE
                [
                    'name'=>'staff-website',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can view website module',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can view website announcement settings',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-add',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can add a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-view',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can view a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-edit',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can edit a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-publish',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can publish a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-unpublish',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can unpublish a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-mail',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can mail a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-website-announcement-delete',
                    'portal'=>'staff',
                    'module'=>'website',
                    'description'=>'Can delete a website announcement',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->WEBSITE

                // STAFF->SYSTEM
                [
                    'name'=>'staff-system',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can access to system page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-import-students',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can import students',
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
                    'name'=>'staff-system-lab',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view exam labs',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-lab-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add exam labs',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-lab-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit exam labs',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-lab-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete exam labs',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view banks',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add banks',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit banks',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete banks',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-branch',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can view bank branches',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-branch-add',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can add bank branches',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-branch-edit',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can edit bank branches',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                [
                    'name'=>'staff-system-bank-branch-delete',
                    'portal'=>'staff',
                    'module'=>'system',
                    'description'=>'Can delete bank branches',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                // /STAFF->SYSTEM
                // /STAFF PORTAL
            )
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
