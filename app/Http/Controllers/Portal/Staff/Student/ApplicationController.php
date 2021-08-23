<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\Student;
use App\Models\Student\Document;
use App\Models\Student\Payment;
use App\Models\Student\Registration;
use App\Models\Support\Bank;
use App\Models\Support\BankBranch;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\Support\WorldCity;
use App\Models\Support\WorldCountry;
use App\Models\Support\WorldDivision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    // NEW APPLICANT
    public function Applications()
    {
        $registrations = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('application_status', NULL)->where('payment_id', '!=', NULL)->get();
        return view('portal/staff/student/applications', compact('registrations'));
    }

    // NEW APPLICANT PAYMENT
    public function reviewRegPayment(){
        //$registrations = Registration::where('registered_at', NULL)->whereHas('payment', function ($query) {$query->where('status', NULL);})->get();
        $registrations = Registration::where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', NULL)->get();
        return view('portal/staff/student/applications', compact('registrations'));
    }

    // NEW APPLICANT DOCUMENTS
    public function reviewRegDocumentsPending(){
        $registrations = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '0')->get();
        return view('portal/staff/student/applications', compact('registrations'));
    }
    public function reviewRegDocuments(){
        $registrations = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status', NULL)->get();
        return view('portal/staff/student/applications', compact('registrations'));
    }
    // /NEW APPLICANT DOCUMENTS

    // REGISTRATION
    public function reviewRegistration(){
        $regDate = Carbon::now()->isoFormat('YYYY-MM-DD');
        $regExpireDate = Carbon::now()->addYear()->subDay()->isoFormat('YYYY-MM-DD');
        $registrations = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status',  'Approved')->get();
        $isRegistrationActivateView = TRUE;
        return view('portal/staff/student/applications', compact('registrations', 'regDate', 'regExpireDate', 'isRegistrationActivateView'));
    }
    public function registered(){
        $registrations = Registration::where('registered_at', '!=', NULL)->where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status', 'Approved')->where('status', 1)->get();
        return view('portal/staff/student/applications', compact('registrations'));
    }
    // /REGISTRATION



    //GET APPLICANT INFO
    public function applicantInfo(Request $request)
    {
        $registration = Registration::find($request->registration_id);
        $student = Registration::find($request->registration_id)->student;
        $user = User::where('id', $student->user_id)->first();
        $studentFlag = $student->flag;
        $email = $student->user->email;
        $payment = NULL;
        $documents = NULL;
        $lastRegistration = $student->last_registration();
        // PAYMENT DETAILS
        if($registration->payment_id != NULL):
            $payment = $registration->payment;
            $bank = Bank::find($payment->bank_id);
            $bankBranch = BankBranch::find($payment->bank_branch_id);
            $payment = array('details'=>$payment,'bank'=>$bank,'bankBranch'=>$bankBranch);
        endif;
        // DOCUMENT DETAILS
        if($registration->document_submit == 1):
            if($student->document->where('type', 'Birth')->where('side', 'front')->count() > 0):
                $bcFront = $student->document->where('type', 'Birth')->where('side', 'front')->latest()->first()->image;
            else:
                $bcFront = NULL;
            endif;
            if($student->document->where('type', 'Birth')->where('side', 'back')->count() > 0):
                $bcBack = $student->document->where('type', 'Birth')->where('side', 'back')->first()->image;
            else:
                $bcFront = NULL;            
            endif;
            $id = $student->document->whereIn('type', ['NIC', 'Postal', 'Passport'])->where('side', 'front')->first();
            
            if( $id ):
                $idFront = $id->image;
                $idBack = NULL;
                if( $id->type == 'NIC'):
                    $idBack = $student->document->where('type', 'NIC')->where('side', 'back')->first();
                    if($idBack==Null):
                        
                    else:
                        $idBack = $idBack->image;
                    endif;
                endif;
            else:
                $idFront = NULL;
                $idBack = NULL;
            endif;
            $documents = array('bcFront' => $bcFront, 'bcBack' => $bcBack, 'idFront' => $idFront, 'idBack' => $idBack);


        endif;

        //PERMANENT ADDRESS
        $permanentCountry = WorldCountry::where('id',$student->permanent_country_id)->first()->name;
        $permanentState = NULL;
        $permanentCity = NULL;
        //GET DIVISION OR DISTRICT
        if($student->permanent_state_id != NULL):
            if($student->permanent_country_id == 67):
                $permanentState = SlDistrict::where('id',$student->permanent_state_id)->first()->name;
            else:
                $permanentState = WorldDivision::where('id',$student->permanent_state_id)->first()->name;
            endif;
        endif;

        //GET CITY
        if($student->permanent_city_id != NULL):
            if($student->permanent_country_id == 67):
                $permanentCity = SlCity::where('id',$student->permanent_city_id)->first()->name;
            else:
                $permanentCity = WorldCity::where('id',$student->permanent_city_id)->first()->name;
            endif;
        endif;
        $permanentAddressDetails = array('permanentCountry'=>$permanentCountry, 'permanentState'=>$permanentState, 'permanentCity'=>$permanentCity);
        // /PERMANENT ADDRESS

        //CURRENT ADDRESS
        $currentCountry = NULL;
        $currentState = NULL;
        $currentCity = NULL;
        //GET COUNTRY
        if($student->current_country_id != NULL):
            $currentCountry = WorldCountry::where('id',$student->current_country_id)->first()->name;
        endif;
        //GET DIVISION OR DISTRICT
        if($student->current_state_id != NULL):
            if($student->current_country_id == 67):
                $currentState = SlDistrict::where('id',$student->current_state_id)->first()->name;
            else:
                $currentState = WorldDivision::where('id',$student->current_state_id)->first()->name;
            endif;
        endif;

        //GET CITY
        if($student->current_city_id != NULL):
            if($student->current_country_id == 67):
                $currentCity = SlCity::where('id',$student->current_city_id)->first()->name;
            else:
                $currentCity = WorldCity::where('id',$student->current_city_id)->first()->name;
            endif;
        endif;
        $currentAddressDetails = array('currentCountry'=>$currentCountry, 'currentState'=>$currentState, 'currentCity'=>$currentCity);
        // /CURRENT ADDRESS
        return response()->json(['status'=>'success', 'user'=>$user, 'student'=>$student, 'registration'=>$registration, 'lastRegistration' =>$lastRegistration, 'studentFlag'=>$studentFlag, 'payment'=> $payment, 'documents'=> $documents, 'email'=>$email, 'permanentAddressDetails'=>$permanentAddressDetails, 'currentAddressDetails'=>$currentAddressDetails]);

    }

    // APPLICATION
    public function approveApplication(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        if($registration->update(['application_status'=> 'Approved'])):
            $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
            $details = [
                'subject' => 'Registration Details Approved',
                'title' => 'Registration Details Approved',
                'body' => "You will be notified once your registration is successfully complete. Upon successful completion of your registration, you will receive your FIT registration number",
                'color' => '#1b672a'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json([ 'status'=>'success']);
        endif;
        return response()->json([ 'status'=>'error']);
    }

    public function declineApplication(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        if($registration->update(['registered_at'=> NULL, 'registration_expire_at'=>NULL, 'application_submit'=>0, 'application_status'=>'Declined', 'declined_msg'=>$request->declined_msg, 'status'=>NULL])):
            $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
            if($request->declined_msg != NULL):
                $decline_msg = $request->declined_msg;
            else:
                $decline_msg = '';
            endif;
            $details = [
                'subject' => 'Registration Details Declined',
                'title' => 'Registration Details Declined',
                'body' => $decline_msg,
                'color' => '#821919'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json([ 'status'=>'success']);
        endif;
        return response()->json([ 'status'=>'error']);
    }
    // /APPLICATION

    // PAYMENT
    public function approvePayment(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        $payment = Payment::where('id', $registration->first()->payment_id);
        if($payment->update(['status'=>'Approved'])):
            if($registration->update(['payment_status'=>'Approved'])):
                $student = Student::where('id', $registration->first()->student_id)->first();
                $details = [
                    'subject' => 'Registration Payment Approved',
                    'title' => 'Registration Payment Approved',
                    'body' => "<p style='text-align: center; color: #fff;'>Login and Upload the scanned copies of the required documents to complete your registration</P> <p style='text-align: center; color: #fff;'> Upon successful completion of your registration, you will receive your FIT registration number</p>",
                    'color' => '#1b672a'
                ];
                //COMPLETE REGISTRATION IF REGISTRATION RENEWAL PAYMENT
                if(isset($registration->first()->registered_at) && isset($registration->first()->registration_expire_at)):
                    $registration->update(['status'=>1]);
                    $details = [
                        'subject' => 'Registration Renewal Payment Approved',
                        'title' => 'Registration Renewal Payment Approved',
                        'body' => "<p style='text-align: center; color: #fff;'>Your registration renewal process completed</P>",
                        'color' => '#1b672a'
                    ];
                endif;
                Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                return response()->json([ 'status'=>'success']);
            endif;
        endif;
        return response()->json([ 'status'=>'error']);
    }

    public function declinePayment(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        $payment = Payment::where('id', $registration->first()->payment_id);
        if($payment->update(['status'=>'Declined'])):
            if($registration->update(['payment_status'=>'Declined', 'declined_msg'=>$request->declined_msg, 'status'=>NULL])):
                $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
                if($request->declined_msg != NULL):
                    $decline_msg = $request->declined_msg;
                else:
                    $decline_msg = '';
                endif;
                $details = [
                    'subject' => 'Registration Payment Declined',
                    'title' => 'Registration Payment Declined',
                    'body' => $decline_msg,
                    'color' => '#821919'
                ];
                Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                return response()->json([ 'status'=>'success']);
            endif;
        endif;
        return response()->json([ 'status'=>'error']);
    }
    // PAYMENT

    // DOCUMENTS
    public function approveDocuments(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        if($registration->update(['document_status'=>'Approved'])):
            $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
            $details = [
                'subject' => 'Registration Documents Approved',
                'title' => 'Registration Documents Approved',
                'body' => "You will be notified once your registration is successfully complete. Upon successful completion of your registration, you will receive your FIT registration number",
                'color' => '#1b672a'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json([ 'status'=>'success']);
        endif;
        return response()->json([ 'status'=>'error']);
    }
    public function declineDocumentBirth(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        $student = $registration->first()->student;
        $documents = $student->document()->where('type', 'Birth')->get();
        if($documents):
            foreach($documents as $document):
                Document::destroy($document->id);
            endforeach;
            if($registration->update(['registered_at'=>NULL, 'registration_expire_at'=>NULL, 'document_submit'=>0, 'document_status'=>'Declined', 'declined_msg'=>$request->declined_msg, 'status'=>NULL])):
                $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
                if($request->declined_msg != NULL):
                    $decline_msg = $request->declined_msg;
                else:
                    $decline_msg = '';
                endif;
                $details = [
                    'subject' => 'Registration - Birth Certificate Declined',
                    'title' => 'Registration - Birth Certificate Declined',
                    'body' => $decline_msg,
                    'color' => '#821919'
                ];
                Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                return response()->json([ 'status'=>'success']);
            endif;
        endif;
        return response()->json([ 'status'=>'error']);
    }
    public function declineDocumentId(Request $request){
        $registration = Registration::where('id', $request->registration_id);
        $student = $registration->first()->student;
        $documents = $student->document()->where('type', $request->docType)->get();
        if($documents):
            foreach($documents as $document):
                Document::destroy($document->id);
            endforeach;
            if($registration->update(['registered_at'=>NULL, 'registration_expire_at'=>NULL, 'document_submit'=>0, 'document_status'=>'Declined', 'declined_msg'=>$request->declined_msg, 'status'=>NULL])):
                $student = Student::where('id', Registration::where('id', $request->registration_id)->first()->student_id)->first();
                if($request->declined_msg != NULL):
                    $decline_msg = $request->declined_msg;
                else:
                    $decline_msg = '';
                endif;
                $details = [
                    'subject' => 'Registration - Identity Document Declined',
                    'title' => 'Registration - Identity Document Declined',
                    'body' => $decline_msg,
                    'color' => '#821919'
                ];
                Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                return response()->json([ 'status'=>'success']);
            endif;
        endif;
        return response()->json([ 'status'=>'error']);
    }
    // /DOCUMENTS

    // REGISTRATION
    public function registerStudent(Request $request){

        $validator = Validator::make($request->all(),[
            'registration_id' => 'required',
            'regDate' => 'required',
            'regExpireDate' => 'required',
            'regStatus' => 'required'
        ]);

        if($validator->fails()):
            return response()->json([ 'status'=>'error', 'data'=>"All input fields are mandatory to proceed activation"]);
        endif;

        $registration = Registration::where('id', $request->registration_id);
        $flag = $registration->first()->flag;
        $student = $registration->first()->student;

        // CHECKING ENROLLMENT
        if($flag->enrollment == 'new'):

            // REGISTER NEW STUDENT
            $dateFormat = Carbon::now()->isoFormat('YYMMDD');
            $lastRegNo = Student::where('reg_no', 'like', 'F'.$dateFormat.'%')->orderBy('reg_no', 'desc')->first();
            //CHECK ANY STUDENT REGISTERED TODAY
            if($lastRegNo != NULL):
                //GENERATE NEXT REG_NO
                $lastRegNoSerial = (int)substr($lastRegNo->reg_no, -3);
                $newRegNoSerial = $lastRegNoSerial+1;
                $newRegNoSerialCode = str_pad($newRegNoSerial, 3, '0', STR_PAD_LEFT);
                //SAVE REG NO
                if($registration->first()->student()->update(['reg_no'=>'F'.$dateFormat.$newRegNoSerialCode, 'reg_year'=> Carbon::now()->year])):
                    // UPDATE REGISTRATION
                    if($registration->update(['registered_at'=>$request->regDate, 'registration_expire_at'=>$request->regExpireDate, 'status'=>$request->regStatus ])):
                        $student = $registration->first()->student;
                        $details = [
                            'subject' => 'You Are Registered!',
                            'title' => 'Cheers! Welcome Aboard! You are now a successfully registered FIT student.',
                            'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: ".$student->reg_no." </p><p style='color: #fff;'>Registered at: ".$request->regDate." </p><p style='color: #fff;'> Registration Expires at: ".$request->regExpireDate." </p>
                                        <p>You can try login to the VLE (<a href='http://fit.bit.lk/vle'>http://fit.bit.lk/vle</a>) after two two weeks time, from today, using your Registration Number as the username and the NIC / Passport number as the password.</p>", 
                            'color' => '#1b672a'
                        ];
                        Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                        return response()->json([ 'status'=>'success']);
                    endif;
                endif;
            else:
                //SAVE REG NO
                if($registration->first()->student()->update(['reg_no'=>'F'.$dateFormat.'001', 'reg_year'=> Carbon::now()->year])):
                    // UPDATE REGISTRATION
                    if($registration->update(['registered_at'=>$request->regDate, 'registration_expire_at'=>$request->regExpireDate, 'status'=>$request->regStatus ])):
                        $student = $registration->first()->student;
                        $details = [
                            'subject' => 'You Are Registered!',
                            'title' => 'Cheers! Welcome Aboard! You are now a successfully registered FIT student.',
                            'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: ".$student->reg_no." </p><p style='color: #fff;'>Registered at: ".$request->regDate." </p><p style='color: #fff;'> Registration Expires at: ".$request->regExpireDate." </p>
                                        <p>You can try login to the VLE (<a href='http://fit.bit.lk/vle'>http://fit.bit.lk/vle</a>) after two two weeks time, from today, using your Registration Number as the username and the NIC / Passport number as the password.</p>", 
                            'color' => '#1b672a'
                        ];
                        Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                        return response()->json([ 'status'=>'success']);
                    endif;
                endif;
            endif;
            // /REGISTER NEW STUDENT
        
        elseif($flag->enrollment == 'existing'):

            // ENROLL EXISTING STUDENT
            if($registration->update(['registered_at'=>$request->regDate, 'registration_expire_at'=>$request->regExpireDate, 'status'=>$request->regStatus ])):
                $details = [
                    'subject' => 'You Are Registered!',
                    'title' => 'Cheers! Welcome Aboard! You are now a successfully registered FIT student.',
                    'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: ".$student->reg_no." </p><p style='color: #fff;'>Registered at: ".$request->regDate." </p><p style='color: #fff;'> Registration Expires at: ".$request->regExpireDate." </p>
                                <p>You can try login to the VLE (<a href='http://fit.bit.lk/vle'>http://fit.bit.lk/vle</a>) after two two weeks time, from today, using your Registration Number as the username and the NIC / Passport number as the password.</p>", 
                    'color' => '#1b672a'
                ];
                Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                return response()->json([ 'status'=>'success']);
            endif;
            // /ENROLL EXISTING STUDENT
            
        endif;

        return response()->json([ 'status'=>'error', 'data'=>$dateFormat]);
    }

    public function registerAllStudents(){

        $registrations = Registration::select('id')->where('registered_at', NULL)->where('application_submit', '1')->where('application_status', "Approved")->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status',  'Approved')->get();
        foreach($registrations as $currentRegistration):
            $registration = Registration::where('id', $currentRegistration->id);
            $flag = $registration->first()->flag;
            $student = $registration->first()->student;

            $regDate =  Carbon::now()->isoFormat('YYYY-MM-DD');
            $regExpireDate = Carbon::now()->addYear()->subDay()->isoFormat('YYYY-MM-DD');

            // CHECKING ENROLLMENT
            if($flag->enrollment == 'new'):

                // REGISTER NEW STUDENT
                $dateFormat = Carbon::now()->isoFormat('YYMMDD');
                $lastRegNo = Student::where('reg_no', 'like', 'F'.$dateFormat.'%')->orderBy('reg_no', 'desc')->first();
                //CHECK ANY STUDENT REGISTERED TODAY
                if($lastRegNo != NULL):
                    //GENERATE NEXT REG_NO
                    $lastRegNoSerial = (int)substr($lastRegNo->reg_no, -3);
                    $newRegNoSerial = $lastRegNoSerial+1;
                    $newRegNoSerialCode = str_pad($newRegNoSerial, 3, '0', STR_PAD_LEFT);
                    //SAVE REG NO
                    if($registration->first()->student()->update(['reg_no'=>'F'.$dateFormat.$newRegNoSerialCode, 'reg_year'=> Carbon::now()->year])):
                        // UPDATE REGISTRATION
                        if($registration->update(['registered_at'=>$regDate, 'registration_expire_at'=>$regExpireDate, 'status'=>1 ])):
                            $student = $registration->first()->student;
                            $details = [
                                'subject' => 'You Are Registered!',
                                'title' => 'Cheers! Welcome Aboard! You are now a successfully registered FIT student.',
                                'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: ".$student->reg_no." </p><p style='color: #fff;'>Registered at: ".$regDate." </p><p style='color: #fff;'> Registration Expires at: ".$regExpireDate." </p>
                                            <p>You can try login to the VLE (<a href='http://fit.bit.lk/vle'>http://fit.bit.lk/vle</a>) after two two weeks time, from today, using your Registration Number as the username and the NIC / Passport number as the password.</p>", 
                                'color' => '#1b672a'
                            ];
                            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                        endif;
                    endif;
                else:
                    //SAVE REG NO
                    if($registration->first()->student()->update(['reg_no'=>'F'.$dateFormat.'001', 'reg_year'=> Carbon::now()->year])):
                        // UPDATE REGISTRATION
                        if($registration->update(['registered_at'=>$regDate, 'registration_expire_at'=>$regExpireDate, 'status'=>1 ])):
                            $student = $registration->first()->student;
                            $details = [
                                'subject' => 'You Are Registered!',
                                'title' => 'Cheers! Welcome Aboard! You are now a successfully registered FIT student.',
                                'body' => "<h3 style='text-align: center; color: #fff;'>Registration Details</h3><p style='color: #fff;'>Registration Number: ".$student->reg_no." </p><p style='color: #fff;'>Registered at: ".$regDate." </p><p style='color: #fff;'> Registration Expires at: ".$regExpireDate." </p>
                                            <p>You can try login to the VLE (<a href='http://fit.bit.lk/vle'>http://fit.bit.lk/vle</a>) after two two weeks time, from today, using your Registration Number as the username and the NIC / Passport number as the password.</p>", 
                                'color' => '#1b672a'
                            ];
                            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
                        endif;
                    endif;
                endif;
                // /REGISTER NEW STUDENT
            endif;
        endforeach;
        return response()->json([ 'status'=>'success']);
    }
    // /REGISTRATION
}
