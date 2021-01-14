<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('student.auth');
        $this->middleware('student.payment.submit.check');
    }
    
    public function index(){
        $student = Auth::user()->student;
        $registration = $student->registration()->where('status', NULL)->first();
        if($student->nic_old != Null || $student->nic_new != Null):
            $document_type='NIC';
        elseif($student->postal != Null):
            $document_type='Postal';
        
        elseif($student->passport != Null):
            $document_type='Passport';
        endif;
        return view('portal/student/documents/documents', compact('student', 'document_type', 'registration'));
    }

    // UPLOAD BIRTH CERTIFICATE
    public function uploadBirth(Request $request){
        $validator = Validator::make($request->all(), 
            [     
                'birthCertificateFront'=> ['required', 'image'],
                'birthCertificateBack'=>['required', 'image']
            ]);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $student_id = Auth::user()->student->id;
            
            $birth_front_ext = $request->file('birthCertificateFront')->getClientOriginalExtension();
            $birth_back_ext = $request->file('birthCertificateBack')->getClientOriginalExtension();
            $birth_front_name = $student_id.'_birth_front_'.date('Y-m-d').'_'.time().'.'. $birth_front_ext;
            $birth_back_name = $student_id.'_birth_back_'.date('Y-m-d').'_'.time().'.'. $birth_back_ext;
    
    
            //SAVE BC FRONT IMAGE
            if($path = $request->file('birthCertificateFront')->storeAs('public/students/'.$student_id, $birth_front_name)):
                //SAVE BC FRONT IMAGE DB RECORD
                $birth_front = new Document();
                $birth_front->student_id = $student_id;
                $birth_front->type = 'Birth';
                $birth_front->side = 'front';
                $birth_front->image = $birth_front_name;
                if($birth_front->save()):
                    if($path = $request->file('birthCertificateBack')->storeAs('public/students/'.$student_id, $birth_back_name)):
                        $birth_back = new Document();
                        $birth_back->student_id = $student_id;
                        $birth_back->type = 'Birth';
                        $birth_back->side = 'back';
                        $birth_back->image = $birth_back_name;
                        if($birth_back->save()):
                            return response()->json(['success'=>'success']);
                        endif;
                    endif;
                endif;
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /UPLOAD BIRTH CERTIFICATE

    // DELETE BIRTH CERTIFICATE
    public function deleteBirth(){
        $student = Auth::user()->student;
        $birth_certificates = $student->document()->where('type', 'birth')->get();
        foreach($birth_certificates as $birth_certificate):
            Document::destroy($birth_certificate->id);
        endforeach;
        return response()->json(['status'=>'success', $birth_certificates]);
    }
    // /DELETE BIRTH CERTIFICATE

    // UPLOAD ID
    public function uploadId(Request $request){
        $validator_front = Validator::make($request->all(), 
        [     
            'documentFront'=> ['required', 'image']
        ]);

        if(Auth::user()->student->nic_old != Null):
            $validator_back = Validator::make($request->all(), 
            [     
                'documentBack'=> ['required', 'image']
            ]);
        else:
            $validator_back = Validator::make($request->all(), 
            [     
                'documentBack'=> ['image']
            ]);
        endif;

        // CHECK VALIDATIONS
        if($validator_front->fails() || $validator_back->fails()):
            return response()->json(['errors'=>array_merge(json_decode($validator_front->errors(), true), json_decode($validator_back->errors(),true))]);
        else:
            $student_id = Auth::user()->student->id;

            //SET FRONT IMAGE
            $front_ext = $request->file('documentFront')->getClientOriginalExtension();
            $front_name = $student_id.'_'.$request->document_type.'_front_'.date('Y-m-d').'_'.time().'.'. $front_ext;
    
            if($request->documentBack != NULL):
                $back_ext = $request->file('documentBack')->getClientOriginalExtension();
                $back_name = $student_id.'_'.$request->document_type.'_back_'.date('Y-m-d').'_'.time().'.'. $back_ext;
            endif;
    
            //SAVE ID FRONT IMAGE
            if($path = $request->file('documentFront')->storeAs('public/students/'.$student_id, $front_name)):
                //SAVE ID FRONT IMAGE DB RECORD
                $id_front = new Document();
                $id_front->student_id = $student_id;
                $id_front->type = $request->document_type;
                $id_front->side = 'front';
                $id_front->image = $front_name;
                if($id_front->save()):
                    if($request->documentBack != NULL):
                        // SAVE ID BACK IMAGE
                        if($path = $request->file('documentBack')->storeAs('public/students/'.$student_id, $back_name)):
                            // SAVE ID BACK IMAGE D RECORD
                            $id_back = new Document();
                            $id_back->student_id = $student_id;
                            $id_back->type = $request->document_type;
                            $id_back->side = 'back';
                            $id_back->image = $back_name;
                            if($id_back->save()):
                                return response()->json(['status'=>'success']);
                            endif;
                        endif;
                    else:
                        return response()->json(['status'=>'success']);
                    endif;
                endif;
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /UPLOAD ID

    // DELETE ID
    public function deleteId(){
    $student = Auth::user()->student;
    if($student->nic_old != Null || $student->nic_new != Null):
        $document_type='NIC';
    else:
        if($student->postal != Null):
            $document_type='Postal';
        else:
            if($student->passport != Null):
                $document_type='Passport';
            endif;
        endif;
    endif;

    $IDs = $student->document()->where('type', $document_type)->get();
    foreach($IDs as $ID):
        Document::destroy($ID->id);
    endforeach;
    return response()->json(['status'=>'success', $IDs]);
    }
    // /DELETE ID

    // SUBMIT DOCS
    public function submitDocs(){
        $student = Auth::user()->student;
        $registration = $student->registration()->where('document_submit', '!= ','OK')->first();
        if ( $registration->update(['document_submit' => 1])):
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /SUBMIT DOCS
}
