<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Anouncements;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\DataTables\Facades\DataTables;

class WebsiteController extends Controller
{
            /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('staff.auth');
    }
    public function index(Request $request)
    {
        return view('portal.staff.website');
    }
    public function getAnnouncementList(Request $request)
    {
        if ($request->ajax()) {
            $data = Anouncements::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function createAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'title'=> ['required']
            ]
        );

        if( $request->description == Null ):
            $validator1 = Validator::make($request->all(), 
                [     
                    'image'=> ['required', 'image', 'mimes:jpeg,png']
                ]
            );
        else:
            $validator1 = Validator::make($request->all(), 
                [     
                    'image'=> ['nullable', 'image', 'mimes:jpeg,png']
                ]
            );
        endif;

        if( $request->image == Null ):
            $validator2 = Validator::make($request->all(), 
                [     
                    'description'=> ['required']
                ]
            );
        else:
            $validator2 = Validator::make($request->all(), 
                [     
                    'description'=> ['nullable']
                ]
            );
        endif; 

        if( $request->buttonText == Null ):
            $validator3 = Validator::make($request->all(), 
                [     
                    'buttonLink'=> ['nullable']
                ]
            );
        else:
            $validator3 = Validator::make($request->all(), 
                [     
                    'buttonLink'=> ['required']
                ]
            );
        endif;   

        if($validator->fails() || $validator1->fails() || $validator2->fails() || $validator3->fails()):
            return response()->json(['errors'=>$validator->errors()->merge($validator1->errors())->merge($validator2->errors())->merge($validator3->errors())]);
        else:
            $announcement = new Anouncements();
            $announcement->title = $request->title;
            $announcement->description = $request->description;
            $announcement->button_text = $request->buttonText;
            $announcement->button_link = $request->buttonLink;

            if($request->image != Null):
                $image_ext = $request->file('image')->getClientOriginalExtension();
                $img_name = $request->title.'_announcement_'.date('Y-m-d').'_'.time().'.'. $image_ext;
                $announcement->image = $img_name;  

                if($path = $request->file('image')->storeAs('public/announcements/', $img_name)):
                else:                    
                    return response()->json(['error'=>'error']);
                endif;
            endif;

            if($announcement->save()):                
                return response()->json(['success'=>'success']);
            endif;
            
        endif;
        return response()->json(['error'=>'error']);

    }

    public function ckeditorUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.date('Y-m-d').'_'.time().'.'.$extension;
            $request->file('upload')->storeAs('public/announcements/images', $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/announcements/images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

}
