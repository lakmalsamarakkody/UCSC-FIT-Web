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
    public function __construct() 
    {
        $this->middleware('student.auth');
        $this->middleware('student.payment.submit.check');
    }
    
    public function index()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        $registration = $student->registration()->where('status', NULL)->first();
        $payment = $registration->payment()->first();
        if($student->nic_old != Null || $student->nic_new != Null):
            $document='NIC';
        else:
            if($student->postal != Null):
                $document='Postal';
            else:
                if($student->passport != Null):
                    $document='Passport';
                endif;
            endif;
        endif;
        return view('portal/student/documents/documents', compact('student', 'document', 'registration', 'payment'));
    }

    public function uploadBirth(Request $request)
    {
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
            if($path = $request->file('birthCertificateFront')->storeAs('public/documents/'.$student_id, $birth_front_name)):
                //SAVE BC FRONT IMAGE DB RECORD
                $birth_front = new Document();
                $birth_front->student_id = $student_id;
                $birth_front->type = 'birth';
                $birth_front->side = 'front';
                $birth_front->image = $birth_front_name;
                if($birth_front->save()):
                    if($path = $request->file('birthCertificateBack')->storeAs('public/documents/'.$student_id, $birth_back_name)):
                        $birth_back = new Document();
                        $birth_back->student_id = $student_id;
                        $birth_back->type = 'birth';
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

    public function uploadId(Request $request)
    {
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

        if($validator_front->fails() || $validator_back->fails()):
            return response()->json(['errors'=>array_merge(json_decode($validator_front->errors(), true), json_decode($validator_back->errors(),true))]);
        else:
            $student_id = Auth::user()->student->id;
            
            $file_ext = $request->file('birthCertificateFront')->getClientOriginalExtension();
            $file_name = $student_id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;
    
    
            if($path = $request->file('birthCertificateFront')->storeAs('public/birthCertificates/birthCertificates',$file_name)):

                return response()->json(['success'=>'success']);

    
            endif;
    
        endif;
      return response()->json(['error'=>'error']);
    }

}
