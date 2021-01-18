<?php

use App\Mail\StudentRegistration;
use App\Mail\Subscribe;
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

Route::post('logout',[App\Http\Controllers\Auth\LoginController::class,'logout']);

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

Route::get('/portal/staff/students', [App\Http\Controllers\Portal\Staff\StudentController::class, 'index'])->name('students');
Route::get('student-list',[App\Http\Controllers\Portal\Staff\StudentController::class, 'getStudentList'])->name('student.list');
Route::get('/portal/staff/student/profile',[App\Http\Controllers\Portal\Staff\StudentController::class, 'viewStudent'])->name('student.profile');

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
Route::get('/portal/staff/student/registered', [App\Http\Controllers\Portal\Staff\Student\ApplicationController::class, 'registered'])->name('student.application.registered');

// EXAM CARDS
Route::get('/portal/staff/student/exams/application', [App\Http\Controllers\Portal\Staff\Student\ExamApplicationController::class, 'index'])->name('student.exams');
// /HOME PAGE

// EXAMS PAGE
Route::get('/portal/staff/exams', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'index'])->name('exams');
Route::get('exam-list',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'getExamList'])->name('exams.list');
Route::post('/portal/staff/exams/schedule/create',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'createExamSchedule'])->name('schedule.create');
Route::post('/portal/staff/exams/schedule/edit/details',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'editScheduleGetDetails']);
Route::post('/portal/staff/exams/schedule/edit',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'editExamSchedule']);
Route::post('/portal/staff/exams/schedule/delete',[App\Http\Controllers\Portal\Staff\ExamsController::class, 'deleteExamSchedule']);
Route::get('/portal/staff/exams/held/search', [App\Http\Controllers\Portal\Staff\ExamsController::class, 'index'])->name('exams.held.search');
// /EXAMS PAGE

// EXAM LIST PAGE
Route::get('/portal/staff/exams/list', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class, 'index']);
Route::post('/portal/staff/exams/list/create', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class, 'createExam']);
Route::post('/portal/staff/exams/list/delete', [App\Http\Controllers\Portal\Staff\Exams\ExamListController::class , 'deleteExam']);
// /EXAM LIST PAGE

Route::get('/portal/staff/results', [App\Http\Controllers\Portal\Staff\ResultsController::class, 'index'])->name('results');
Route::get('/portal/staff/result/view/{id}', [App\Http\Controllers\Portal\Staff\ResultsController::class, 'viewResults'])->where('id', '[0-9]+')->name('results.view');

Route::get('/portal/staff/users', [App\Http\Controllers\Portal\Staff\UsersController::class, 'index'])->name('users');
Route::get('/portal/staff/users/user-list',[App\Http\Controllers\Portal\Staff\UsersController::class, 'getUserList'])->name('user.list');
Route::get('/portal/staff/user/profile',[App\Http\Controllers\Portal\Staff\UsersController::class, 'viewUser'])->name('user.profile');

// SYSTEM PAGE
Route::get('/portal/staff/system', [App\Http\Controllers\Portal\Staff\SystemController::class, 'index'])->name('system');

Route::post('/portal/staff/system/createUserRole', [App\Http\Controllers\Portal\Staff\SystemController::class, 'createUserRole']);
Route::post('/portal/staff/system/viewUserRoleGetDetails', [App\Http\Controllers\Portal\Staff\SystemController::class, 'viewUserRoleGetDetails']);
Route::post('/portal/staff/system/deleteUserRole', [App\Http\Controllers\Portal\Staff\SystemController::class, 'deleteUserRole']);

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

// INFROMATION PAGE
Route::get('/portal/student/information', [App\Http\Controllers\Portal\Student\InformationController::class, 'index'])->name('student.information');
Route::post('/portal/student/information/update/qualification', [App\Http\Controllers\Portal\Student\InformationController::class, 'updateQualification'])->name('update.qualification');
// /INFROMATION PAGE
Route::get('/portal/student/exams',[App\Http\Controllers\Portal\Student\ExamsController::class,'index'])->name('student.exams');

Route::get('/portal/student/results',[App\Http\Controllers\Portal\Student\ResultsController::class,'index'])->name('student.results');

// PAYMENT PAGE
Route::get('/portal/student/payment/registration',[App\Http\Controllers\Portal\Student\PaymentController::class,'registration'])->name('payment.registration');
Route::post('/portal/student/payment/registration',[App\Http\Controllers\Portal\Student\PaymentController::class,'saveRegPayment']);
Route::get('/portal/student/payment/exam',[App\Http\Controllers\Portal\Student\PaymentController::class,'exam'])->name('payment.exam');
Route::post('/portal/student/payment/exam',[App\Http\Controllers\Portal\Student\PaymentController::class,'saveExamPayment']);
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