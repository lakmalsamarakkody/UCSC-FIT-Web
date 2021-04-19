<?php

use App\Mail\Announcement;
use App\Mail\StudentRegistration;
use App\Mail\Subscribe;
use App\Models\Anouncements;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|   example -   Method 1 -  use App\Http\Controllers\HomeController;
|                           Route::get('/home',[HomeController::class,'indexhome']);
|               Method 2 -  Route::get('/home',[App\Http\Controllers\HomeController::class,'indexhome']);
*/

Route::post('logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
Route::get('logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| WEBSITE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [App\Http\Controllers\Website\Home::class,'index']);
Route::get('/programme', [App\Http\Controllers\Website\Program::class,'index']);
Route::get('/registration',[App\Http\Controllers\Website\Registration::class,'index']);
Route::get('/learning',[App\Http\Controllers\Website\Learning::class,'index']);
Route::get('/contact',[App\Http\Controllers\Website\Contact::class,'index']);
Route::get('/examination',[App\Http\Controllers\Website\Examination::class,'index']);
Route::get('/faq',[App\Http\Controllers\Website\Faq::class, 'index']);
Route::get('/announcements', [App\Http\Controllers\Website\AnouncementsController::class, 'index']);
Route::get('/announcement/{id}', [App\Http\Controllers\Website\AnouncementsController::class, 'viewAnnouncement'])->name('web.announcement');
Route::get('/privacyPolicy',[App\Http\Controllers\Website\PrivacyPolicy::class, 'index']);
Route::get('/terms',[App\Http\Controllers\Website\Terms::class, 'index']);
Route::get('/siteMap',[App\Http\Controllers\Website\SiteMap::class, 'index']);
Route::get('/downloads',[App\Http\Controllers\Website\Downloads::class, 'index']);

Route::post('/student/registration',[App\Http\Controllers\Website\Registration::class,'emailLink']);
Route::post('/student/registration/subscribe',[App\Http\Controllers\Website\Registration::class,'subscribe']);

Route::get('/{email}/unsubscribe/{token}', [App\Http\Controllers\Website\Registration::class,'unsubscribe'])->name('unsubscribe');


/*
|--------------------------------------------------------------------------
| PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::post('/portal/information/upload/profilePic', [App\Http\Controllers\Portal\AccountController::class, 'uploadProfilePic'])->name('upload.profile.pic');
Route::post('/portal/information/select/profilePic', [App\Http\Controllers\Portal\AccountController::class, 'selectProfilePic'])->name('select.profile.pic');
Route::post('/portal/information/update/email', [App\Http\Controllers\Portal\AccountController::class, 'updateEmail'])->name('update.email');
Route::get('/portal/information/verify/{email}/token/{token}/id/{id}', [App\Http\Controllers\Portal\AccountController::class, 'verifyEmail'])->name('change.email.verify');
Route::post('/portal/information/update/password', [App\Http\Controllers\Portal\AccountController::class, 'changePassword'])->name('change.password');
Route::get('/email/changed/success', [App\Http\Controllers\Portal\EmailChanged::class, 'index'])->name('changed.success');

/*
|--------------------------------------------------------------------------
| STAFF PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/portal/staff/', [App\Http\Controllers\Portal\Staff\HomeController::class, 'index'])->name('home');

// STUDENT PAGE
Route::get('/portal/staff/students', [App\Http\Controllers\Portal\Staff\StudentController::class, 'index'])->name('students');
Route::get('student-list',[App\Http\Controllers\Portal\Staff\StudentController::class, 'getStudentList'])->name('student.list');
Route::get('/portal/staff/student/profile/{id}/',[App\Http\Controllers\Portal\Staff\StudentController::class, 'viewStudent'])->name('student.profile');
Route::post('/portal/staff/student/profile/update/email/request',[App\Http\Controllers\Portal\Staff\StudentController::class, 'emailUpdateRequest'])->name('update.email.request');
Route::post('/portal/staff/student/profile/deactivate/account',[App\Http\Controllers\Portal\Staff\StudentController::class, 'deactivateAccount'])->name('deactivate.student');
Route::post('/portal/staff/student/profile/reactivate/account',[App\Http\Controllers\Portal\Staff\StudentController::class, 'reactivateAccount'])->name('reactivate.student');
Route::post('/portal/staff/student/profile/medical/details',[App\Http\Controllers\Portal\Staff\StudentController::class, 'getMedicalDetails'])->name('profile.medical.details');
// /STUDENT PAGE

// HOME PAGE
// REGISTRATION CARDS
Route::get('/portal/staff/student/application', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'Applications'])->name('student.application');
Route::post('/portal/staff/student/application/applicantInfo', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'applicantInfo'])->name('student.application.applicantInfo');
Route::post('/portal/staff/student/application/approveApplication', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'approveApplication'])->name('student.application.approveApplication');
Route::post('/portal/staff/student/application/declineApplication', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'declineApplication'])->name('student.application.declineApplication');
Route::get('/portal/staff/student/application/payment', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'reviewRegPayment'])->name('student.application.reviewRegPayment');
Route::post('/portal/staff/student/application/approvePayment', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'approvePayment'])->name('student.application.approvePayment');
Route::post('/portal/staff/student/application/declinePayment', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'declinePayment'])->name('student.application.declinePayment');
Route::get('/portal/staff/student/application/documents/pending', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'reviewRegDocumentsPending'])->name('student.application.reviewRegDocumentsPending');
Route::get('/portal/staff/student/application/documents', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'reviewRegDocuments'])->name('student.application.reviewRegDocuments');
Route::post('/portal/staff/student/application/approveDocuments', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'approveDocuments'])->name('student.application.approveDocuments');
Route::post('/portal/staff/student/application/declineDocumentBirth', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'declineDocumentBirth'])->name('student.application.declineDocumentBirth');
Route::post('/portal/staff/student/application/declineDocumentId', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'declineDocumentId'])->name('student.application.declineDocumentId');
Route::get('/portal/staff/student/application/reviewRegistration', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'reviewRegistration'])->name('student.application.reviewRegistration');
Route::post('/portal/staff/student/application/registerStudent', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'registerStudent'])->name('student.application.registerStudent');
Route::get('/portal/staff/student/registered', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'registered'])->name('student.application.registered');
// /REGISTRATION CARDS

// EXAM CARDS
// EXAM APPLICATION
Route::get('/portal/staff/student/exams/application/payments', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'reviewExamPayments'])->name('student.application.exams.payments');
Route::post('/portal/staff/student/exams/application/payment/approve', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'approveExamPayment'])->name('student.application.exams.payment.approve');
Route::post('/portal/staff/student/exams/application/payment/decline', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'declineExamPayment'])->name('student.application.exams.payment.decline');
Route::get('/portal/staff/student/exams/applications', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'reviewExamApplications'])->name('student.application.exams');
Route::post('/portal/staff/student/exams/application/details', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'getApplicantExamDetails'])->name('student.application.exams.details');
Route::post('/portal/staff/student/exams/application/details/table', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'appliedExamsTable'])->name('student.application.exams.details.table');
Route::post('/portal/staff/student/exams/application/schedules/details', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'getAppliedSubjectScheduleDetails'])->name('student.application.exams.schedules.details');
Route::post('/portal/staff/student/exams/application/schedules/table', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'schedulesForExamTable'])->name('student.application.exams.schedules.table');
// Route::post('/portal/staff/student/exams/application/schedules/search', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'searchSchedulesByExam'])->name('student.application.exams.schedules.search');
Route::post('/portal/staff/student/exams/application/schedule/exam', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'scheduleAppliedExam'])->name('student.application.exams.schedule.exam');
Route::post('/portal/staff/student/exams/application/schedules/approve', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'approveScheduledExams'])->name('student.application.exams.approve.schedules');

// EXAM MEDICAL
Route::get('/portal/staff/student/exams/medical', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'reviewMedicals'])->name('student.exams.medical');
Route::post('/portal/staff/student/exams/medical/details', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'getMedicalDetails'])->name('student.exams.medical.details');
Route::post('/portal/staff/student/exams/medical/approve', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'approveMedical'])->name('student.exams.medical.approve');
Route::post('/portal/staff/student/exams/medical/decline', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'declineMedical'])->name('student.exams.medical.decline');
Route::post('/portal/staff/student/exams/medical/decline/resubmit', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'declineToResubmitMedical'])->name('student.exams.medical.resubmit.decline');

// EXAM RESCHEDULE
Route::get('/portal/staff/student/exams/reschedule', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'reviewExamsToReschedule'])->name('student.exams.reschedule');
Route::post('/portal/staff/student/exams/reschedule/details', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'getRescheduleExamDetails'])->name('student.exams.reschedule.details');
Route::post('/portal/staff/student/exams/reschedule/table', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'schedulesTableForRescheduleExam'])->name('student.exams.reschedule.table');
Route::post('/portal/staff/student/exams/reschedule/exam', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'rescheduleExam'])->name('student.exams.reschedule.exam');

// /EXAM CARDS
// /HOME PAGE

// EXAMS PAGE
Route::get('/portal/staff/exams', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'index'])->name('exams');
Route::get('/portal/staff/exams/schedules/held',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'getHeldExams'])->name('exams.list');
Route::get('/portal/staff/exams/schedules/before/release', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'getSchedulesBeforeRelease']);
Route::get('/portal/staff/exams/schedules/after/release', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'getSchedulesAfterRelease']);
Route::post('/portal/staff/exams/schedule/create',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'createExamSchedule'])->name('schedule.create');
Route::post('/portal/staff/exams/schedule/edit/details',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'editScheduleGetDetails']);
Route::post('/portal/staff/exams/schedule/edit',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'editExamSchedule']);
Route::post('/portal/staff/exams/schedule/delete',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'deleteExamSchedule']);
Route::post('/portal/staff/exams/schedule/request/approval',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'requestScheduleApproval']);
Route::post('/portal/staff/exams/schedule/approve',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'approveSchedule']);
Route::post('/portal/staff/exams/schedule/decline',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'declineSchedule'])->name('schedule.decline');
Route::post('/portal/staff/exams/schedule/decline/message',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'getScheduleDeclinedMessage'])->name('schedule.decline.message');
Route::post('/portal/staff/exams/schedule/release/individual',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'releaseIndividualSchedule']);
Route::post('/portal/staff/exams/schedule/release/all',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'releaseAllSchedules'])->name('schedule.release.all');

Route::post('/portal/staff/exams/schedule/postpone/details',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'postponeScheduleGetDetails']);
Route::post('/portal/staff/exams/schedule/postpone',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'postponeExam']);
Route::post('/portal/staff/exams/schedule/delete/after/release',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'deleteScheduleAfterRelease']);
//Route::get('/portal/staff/exams/held/search', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'getHeldExams'])->name('exams.held.search');

// EXAM LIST PAGE
Route::get('/portal/staff/exams/list', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class, 'index']);
Route::post('/portal/staff/exams/list/create', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class, 'createExam']);
Route::get('/portal/staff/exams/exams/list', [App\Http\Controllers\Portal\Staff\ExamListController::class, 'getExamList'])->name('exam.exam.list');
Route::post('/portal/staff/exams/list/delete', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class , 'deleteExam']);
// /EXAM LIST PAGE

// EXAM ASSIGN PAGE
Route::get('/portal/staff/exams/assign', [App\Http\Controllers\Portal\Staff\Exams\ExamAssignController::class, 'index'])->name('exams.assign');
Route::get('/portal/staff/exams/assign/schedules/table', [App\Http\Controllers\Portal\Staff\Exams\ExamAssignController::class, 'getSchedulesToAssign'])->name('exams.assign.schedules.table');
Route::post('/portal/staff/exams/assign/schedule/details', [App\Http\Controllers\Portal\Staff\Exams\ExamAssignController::class, 'getExamScheduleDetails'])->name('exams.assign.schedule.details');
Route::get('/portal/staff/exams/assign/students/table', [App\Http\Controllers\Portal\Staff\Exams\ExamAssignController::class, 'getStudentList'])->name('exams.assign.students.table');
Route::post('/portal/staff/exams/assign/students', [App\Http\Controllers\Portal\Staff\Exams\ExamAssignController::class, 'assignStudentsForExam'])->name('exams.assign.students');
// /EXAM ASSIGN PAGE
// /EXAMS PAGE

// RESULTS PAGE
Route::get('/portal/staff/results', [App\Http\Controllers\Portal\Staff\ResultsController::class, 'index'])->name('results');
Route::get('/portal/staff/results/exams', [App\Http\Controllers\Portal\Staff\ResultsController::class, 'getExamList'])->name('results.exam.list');
Route::get('/portal/staff/result/view/{id}', [App\Http\Controllers\Portal\Staff\ResultsController::class, 'viewResults'])->where('id', '[0-9]+')->name('results.view');
// /RESULTS PAGE

// USER PAGE
Route::get('/portal/staff/users', [App\Http\Controllers\Portal\Staff\UsersController::class, 'index'])->name('users');
Route::get('/portal/staff/users/user-list',[App\Http\Controllers\Portal\Staff\UsersController::class, 'getUserList'])->name('user.list');
Route::get('/portal/staff/user/profile/{id}',[App\Http\Controllers\Portal\Staff\UsersController::class, 'viewUser'])->name('user.profile');
Route::post('/portal/staff/user/profile/update/email/request',[App\Http\Controllers\Portal\Staff\UsersController::class, 'emailUpdateRequest'])->name('user.update.email.request');
Route::post('/portal/staff/user/profile/deactivate/account',[App\Http\Controllers\Portal\Staff\UsersController::class, 'deactivateAccount'])->name('deactivate.user');
Route::post('/portal/staff/user/profile/reactivate/account',[App\Http\Controllers\Portal\Staff\UsersController::class, 'reactivateAccount'])->name('reactivate.user');
Route::post('/portal/staff/user/create/user',[App\Http\Controllers\Portal\Staff\UsersController::class, 'createUser'])->name('add.new.user');
// PERMISSIONS
Route::get('/portal/staff/user/permissions',[App\Http\Controllers\Portal\Staff\User\PermissionController::class, 'index'])->name('user.permissions');
Route::post('/portal/staff/user/permission/change',[App\Http\Controllers\Portal\Staff\User\PermissionController::class, 'permissionStatusChanger'])->name('user.permission.change');
// /USER PAGE

// SYSTEM PAGE
Route::get('/portal/staff/system', [App\Http\Controllers\Portal\Staff\SystemController::class, 'index'])->name('system');

Route::post('/portal/staff/system/createUserRole', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createUserRole']);
Route::post('/portal/staff/system/viewUserRoleGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'viewUserRoleGetDetails']);
Route::post('/portal/staff/system/editUserRolePermissions', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editUserRolePermissions']);
Route::post('/portal/staff/system/deleteUserRole', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deleteUserRole']);

Route::get('/portal/staff/system/table/permissions', [App\Http\Controllers\Portal\Staff\SystemController::class, 'getPermissions'])->name('permissions.table');
Route::post('/portal/staff/system/createPermission', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createPermission']);
Route::post('/portal/staff/system/editPermissionGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPermissionGetDetails']);
Route::post('/portal/staff/system/editPermission', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPermission']);
Route::post('/portal/staff/system/deletePermission', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deletePermission']);

Route::post('/portal/staff/system/createSubject', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createSubject']);
Route::post('/portal/staff/system/editSubjectGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editSubjectGetDetails']);
Route::post('/portal/staff/system/editSubject', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editSubject']);
Route::post('/portal/staff/system/deleteSubject', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deleteSubject']);

Route::post('/portal/staff/system/createExamType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createExamType']);
Route::post('/portal/staff/system/editExamTypeGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editExamTypeGetDetails']);
Route::post('/portal/staff/system/editExamType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editExamType']);
Route::post('/portal/staff/system/deleteExamType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deleteExamType']);

Route::post('/portal/staff/system/editExamDuration', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editExamDuration']);

Route::post('/portal/staff/system/createStudentPhase', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createStudentPhase']);
Route::post('/portal/staff/system/editStudentPhaseGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editStudentPhaseGetDetails']);
Route::post('/portal/staff/system/editStudentPhase', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editStudentPhase']);
Route::post('/portal/staff/system/deleteStudentPhase', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deleteStudentPhase']);

Route::post('/portal/staff/system/createPaymentMethod', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createPaymentMethod']);
Route::post('/portal/staff/system/editPaymentMethodGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPaymentMethodGetDetails']);
Route::post('/portal/staff/system/editPaymentMethod', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPaymentMethod']);
Route::post('/portal/staff/system/deletePaymentMethod', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deletePaymentMethod']);

Route::post('/portal/staff/system/createPaymentType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createPaymentType']);
Route::post('/portal/staff/system/editPaymentTypeGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPaymentTypeGetDetails']);
Route::post('/portal/staff/system/editPaymentType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'editPaymentType']);
Route::post('/portal/staff/system/deletePaymentType', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deletePaymentType']);
// /SYSTEM PAGE

// INFORMATION PAGE
Route::get('/portal/staff/information', [App\Http\Controllers\Portal\Staff\InformationController::class, 'index'])->name('staff.information');
// /INFORMATION PAGE

// ANNOUNCEMENT PAGE
Route::get('/portal/staff/website', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'index'])->name('staff.website');
Route::get('/portal/staff/website/announcements', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'getAnnouncementList'])->name('staff.website.announcements');
Route::post('/portal/staff/website/announcements', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'createAnnouncement'])->name('staff.website.announcements.create');
Route::post('/portal/staff/website/announcements/get/details', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'getDetailsAnnouncement'])->name('staff.website.announcements.edit.get.details');
Route::post('ckeditor/upload', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'ckeditorUpload'])->name('ckeditor.image-upload');
Route::post('/portal/staff/website/announcements/email', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'emailAnnouncement'])->name('staff.website.announcements.email');
Route::post('/portal/staff/website/announcements/publish', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'publishAnnouncement'])->name('staff.website.announcements.publish');
Route::post('/portal/staff/website/announcements/unpublish', [App\Http\Controllers\Portal\Staff\WebsiteController::class, 'unpublishAnnouncement'])->name('staff.website.announcements.unpublish');
Route::get('/email', function() {
  $details = [
    // 'subject' => 'Exam Application Scheduled',
    // 'title' => 'Exam Application Scheduled',
    // 'body' => 'Exam Application Scheduled <br><br> Subject: F201 <br> Scheduled Date: 26-05-2021<br> Scheduled Time: 10:30 Am',
    // 'color' => '#1b672a'

    // 'subject' => 'Exam Payment Declined',
    // 'title' => 'Exam Payment Declined',
    // 'body' => 'Exam Payment Declined',
    // 'color' => '#821919'

    // 'subject' => 'Exam Payment Approved',
    // 'title' => 'Exam Payment Approved',
    // 'body' => 'Exam Payment Approved',
    // 'color' => '#1b672a'

    // 'subject' => 'Registration Successful',
    // 'title' => 'Registration Successful',
    // 'body' => 'Registration Successful <br><br> Registration Number: F210326001 <br> Registered Date: 26-03-2021',
    // 'color' => '#1b672a'

    // 'subject' => 'Registration Payment Declined',
    // 'title' => 'Registration Payment Declined',
    // 'body' => 'Registration Payment Declined',
    // 'color' => '#821919'

    // 'subject' => 'Registration Payment Approved',
    // 'title' => 'Registration Payment Approved',
    // 'body' => 'Registration Payment Approved',
    // 'color' => '#1b672a'

    // 'subject' => 'You Are Registered',
    // 'title' => 'You Are Registered',
    // 'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: F201232001 </p><p style='color: #fff;'>Registered at: 12-01-2021 </p><p style='color: #fff;'> Registration Expires at: 12-01-2022 </p>",
    // 'color' => '#1b672a'
  ];
  return new App\Mail\NotificationEmail($details);
});
// /ANNOUNCEMENT PAGE

// GUEST
Route::get('/guest/{email}/fit/{token}/staff/{role}', [App\Http\Controllers\Portal\Staff\GuestController::class,'setPassword'])->name('email.link.staff');
Route::post('/guest/update/account/staff', [App\Http\Controllers\Portal\Staff\GuestController::class,'updateAccount'])->name('update.account.staff');
// /GUEST

/*
|--------------------------------------------------------------------------
| STUDENT PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/portal/student/', [App\Http\Controllers\Portal\Student\HomeController::class, 'index'])->name('student.home');

// REGISTRATION PAGE
Route::get('/portal/student/registration',[App\Http\Controllers\Portal\Student\RegistrationController::class,'index'])->name('student.registration');
Route::post('/portal/student/registration/saveInfoValidator',[App\Http\Controllers\Portal\Student\RegistrationController::class,'saveInfoValidator']);
Route::post('/portal/student/registration/saveInfo',[App\Http\Controllers\Portal\Student\RegistrationController::class,'saveInfo']);
Route::post('/portal/student/registration/checkInfoComplete',[App\Http\Controllers\Portal\Student\RegistrationController::class,'checkInfoComplete']);
Route::post('/portal/student/registration/submitApplication',[App\Http\Controllers\Portal\Student\RegistrationController::class,'submitApplication']);
Route::post('/portal/student/registration/getcountries',[App\Http\Controllers\Portal\Student\RegistrationController::class,'getCountries']);
Route::post('/portal/student/registration/getstates',[App\Http\Controllers\Portal\Student\RegistrationController::class,'getStates']);
Route::post('/portal/student/registration/getcities',[App\Http\Controllers\Portal\Student\RegistrationController::class,'getCities']);
// /REGISTRATION PAGE

// INFORMATION PAGE
Route::get('/portal/student/information', [App\Http\Controllers\Portal\Student\InformationController::class, 'index'])->name('student.information');
Route::post('/portal/student/information/update/qualification', [App\Http\Controllers\Portal\Student\InformationController::class, 'updateQualification'])->name('update.qualification');
Route::post('/portal/student/information/update/contact-details', [App\Http\Controllers\Portal\Student\InformationController::class, 'updateContactDetails']);
Route::post('/portal/student/information/update/employment-details', [App\Http\Controllers\Portal\Student\InformationController::class, 'updateEmploymentDetails']);
Route::post('/portal/student/information/update/get-states', [App\Http\Controllers\Portal\Student\InformationController::class, 'getStates']);
Route::post('/portal/student/information/update/get-cities', [App\Http\Controllers\Portal\Student\InformationController::class, 'getCities']);
// /INFORMATION PAGE

// EXAMS PAGES
Route::get('/portal/student/exams',[App\Http\Controllers\Portal\Student\ExamsController::class,'index'])->name('student.exam');
Route::post('/portal/student/exams/select',[App\Http\Controllers\Portal\Student\ExamsController::class,'selectStudentExams'])->name('student.exam.select');
Route::post('/portal/student/exams/delete',[App\Http\Controllers\Portal\Student\ExamsController::class,'deleteStudentExams'])->name('student.exam.delete');
Route::get('/portal/student/exam/payment',[App\Http\Controllers\Portal\Student\ExamsController::class,'examPayment'])->name('payment.exam');
Route::post('/portal/student/exam/payment',[App\Http\Controllers\Portal\Student\ExamsController::class,'saveExamPayment'])->name('payment.exam.save');
Route::post('/portal/student/exam/declined/message',[App\Http\Controllers\Portal\Student\ExamsController::class,'getExamDeclinedMessage'])->name('student.exam.declined.message');
Route::post('/portal/student/exam/medical/upload',[App\Http\Controllers\Portal\Student\ExamsController::class,'uploadExamMedical'])->name('student.exam.medical.upload');
Route::post('/portal/student/exam/medical/delete',[App\Http\Controllers\Portal\Student\ExamsController::class,'deleteExamMedical'])->name('student.exam.medical.delete');
// /EXAMS PAGE

// RESULT PAGE
Route::get('/portal/student/results',[App\Http\Controllers\Portal\Student\ResultsController::class,'index'])->name('student.results');
// /RESULT PAGE

// PAYMENT PAGE
Route::get('/portal/student/payment/registration',[App\Http\Controllers\Portal\Student\PaymentController::class,'registration'])->name('payment.registration');
Route::post('/portal/student/payment/registration',[App\Http\Controllers\Portal\Student\PaymentController::class,'saveRegPayment']);
// /PAYMENT PAGE

// DOCUMENT PAGE
Route::get('/portal/student/document/registration',[App\Http\Controllers\Portal\Student\DocumentController::class,'index'])->name('document.registration');
Route::post('/portal/student/document/registration/birth',[App\Http\Controllers\Portal\Student\DocumentController::class,'uploadBirth'])->name('document.birth');
Route::post('/portal/student/document/registration/birth/delete',[App\Http\Controllers\Portal\Student\DocumentController::class,'deleteBirth'])->name('document.birth.delete');
Route::post('/portal/student/document/registration/id',[App\Http\Controllers\Portal\Student\DocumentController::class,'uploadId'])->name('document.id');
Route::post('/portal/student/document/registration/id/delete',[App\Http\Controllers\Portal\Student\DocumentController::class,'deleteId'])->name('document.id.delete');
Route::post('/portal/student/document/registration/submit',[App\Http\Controllers\Portal\Student\DocumentController::class,'submitDocs'])->name('document.submit');
// /DOCUMENT PAGE

// GUESTS
Route::get('/guest/{email}/fit/{token}', [App\Http\Controllers\Portal\Student\UserController::class,'setPassword'])->name('email.link');
Route::post('/guest/update/account', [App\Http\Controllers\Portal\Student\UserController::class,'updateAccount'])->name('update.account');
// /GUESTS