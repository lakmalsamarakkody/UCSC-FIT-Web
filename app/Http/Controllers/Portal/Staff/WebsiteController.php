<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Mail\Announcement;
use App\Mail\Subscribe;
use App\Models\Anouncements;
use App\Models\Student;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s'); return $formatedDate; })
            ->editColumn('updated_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('Y-m-d H:i:s'); return $formatedDate; })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function createAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'title'=> ['required'],
                'description'=> ['required']
            ]
        );

 

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:

            if($request->id != '' || $request->id != Null):

                if($announcement = Anouncements::where('id', $request->id)->update([ 'title' => $request->title, 'description' => $request->description, ])):                
                    return response()->json(['updated'=>'success']);
                endif;
            else:            
                $announcement = new Anouncements();
                $announcement->title = $request->title;
                $announcement->description = $request->description;

                if($announcement->save()):                
                    return response()->json(['success'=>'success']);
                endif;
            endif;

            
        endif;
        return response()->json(['error'=>'error']);

    }

    public function ckeditorUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $validator = Validator::make($request->all(), 
                [     
                'upload'=> ['required', 'image']
                ]
            );
            if($validator->fails()):
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = NULL; 
                $msg = $validator->errors()->first('upload'); 
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
                @header('Content-type: text/html; charset=utf-8'); 
                echo $response;
            else:
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
            endif;
        }
    }

    public function getDetailsAnnouncement(Request $request)
    {
        $announcement = Anouncements::find($request->id);
        return $announcement;
    }

    public function emailAnnouncement(Request $request)
    {
        $announcement = Anouncements::where('id', $request->id)->first();

        $subscribers = Subscriber::all();

        foreach( $subscribers as $subscriber ):                
            $details = [
                'title' => $announcement->title,
                'description' => $announcement->description,
                'id' => $announcement->id,
                'email' => $subscriber->email,
                'token' => $subscriber->token
            ];
            
            Mail::to($subscriber->email)->later(now()->addSeconds(5), new Announcement($details));

        endforeach;

        return response()->json(['status'=>'success']); 



    }
}
