<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
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
        return view('portal/student/documents/documents', compact('student', 'document'));
    }

    public function uploadBirth(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [     
            'birthCertificateFront'=> ['required', 'image'],
            'birthCertificateBack'=>['required', 'image']
        ]
      );
      if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
      else:
        $student_id = Auth::user()->student->id;
        
        $file_ext = $request->file('birthCertificateFront')->getClientOriginalExtension();
        $file_1_name = $student_id.'front'.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;
        $file_2_name = $student_id.'back'.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;
  
  
        if($path = $request->file('birthCertificateFront')->storeAs('public/birthCertificates/birthCertificates/'.$student_id, $file_1_name)):
            if($path = $request->file('birthCertificateBack')->storeAs('public/birthCertificates/birthCertificates/'.$student_id, $file_2_name)):
                
                return response()->json(['success'=>'success']);
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
