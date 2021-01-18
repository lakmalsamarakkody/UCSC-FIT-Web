<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\Support\WorldCity;
use App\Models\Support\WorldCountry;
use App\Models\Support\WorldDivision;

class InformationController extends Controller
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
        $this->middleware('student.auth');
        $this->middleware('student.info.view');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countries_list = WorldCountry::orderBy('name')->get();
        // GET STUDENT DETAILS
        if(Student::where('user_id', Auth::user()->id)->first()):
            $student = Student::where('user_id', Auth::user()->id)->first();
        
            //GET STATES AND CITIES FOR PERMANENT ADDRESS
            if($student->permanent_country_id == 67):
                $states_list = SlDistrict::select('id','name')->orderBy('name')->get();
                $city_list = SlCity::select('id','name')->where('district_id', $student->permanent_state_id)->orderBy('name')->get();
            else:
                $states_list = WorldDivision::select('id','name')->where('country_id', $student->permanent_country_id)->orderBy('name')->get();
                //GET CITIES BY DIVISION OR COUNTRY
                if($student->permanent_state_id):
                    $city_list = WorldCity::select('id','name')->where('division_id', $student->permanent_state_id)->orderBy('name')->get();
                else:
                    $city_list = WorldCity::select('id','name')->where('country_id', $student->permanent_country_id)->orderBy('name')->get();
                endif;
            endif;

            //GET STATES AND CITIES FOR CURRENT ADDRESS
            if($student->current_country_id == 67):
                $current_states_list = SlDistrict::select('id','name')->orderBy('name')->get();
                $current_city_list = SlCity::select('id','name')->where('district_id', $student->current_state_id)->orderBy('name')->get();
            else:
                $current_states_list = WorldDivision::select('id','name')->where('country_id', $student->current_country_id)->orderBy('name')->get();
                //GET CITIES BY DIVISION OR COUNTRY
                if($student->current_state_id):
                    $current_city_list = WorldCity::select('id','name')->where('division_id', $student->current_state_id)->orderBy('name')->get();
                else:
                    $current_city_list = WorldCity::select('id','name')->where('country_id', $student->current_country_id)->orderBy('name')->get();
                endif;
            endif;

        else:
            $student = NULL;
            $states_list = NULL;
            $city_list = NULL;
            $current_states_list = NULL;
            $current_city_list = NULL;
        endif;
        return view('portal/student/information', compact('student', 'countries_list', 'states_list', 'current_states_list', 'city_list', 'current_city_list'));
    }

    // UPDATE QUALIFICATION
    public function updateQualification(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'qualification'=> ['required']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            if(Student::where('user_id', Auth::user()->id)->update(['education'=>$request->qualification])):
                return response()->json(['success'=>'success']);
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /UPDATE QUALIFICATION
    
    // UPDATE CONTACT DETAILS
    public function updateContactDetails(Request $request)
    {

    }
    // /UPDATE CONTACT DETAILS

    //GET STATES OR DISTRICTS
    public function getStates(Request $request)
    {
        //Get using country
        if(isset($request->country)):
            // validate country
            $validator = Validator::make($request->all(), [
                'country' => ['required', 'integer', 'exists:world_countries,id'],
            ]);

            if($validator->fails()):
                return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
            else:
                if ( $request->country == '67' ):
                    $state_type = 'districts';
                    $state_list = SlDistrict::select('id','name')->orderBy('name')->get();
                    $city_list = NULL;
                else:
                    $state_type = 'divisions';
                    $state_list = WorldDivision::select('id','name')->where('country_id', $request->country)->orderBy('name')->get();
                    $city_list = WorldCity::select('id','name')->where('country_id', $request->country)->orderBy('name')->get();
                endif;
                return response()->json(['status'=>'success', 'state_type'=>$state_type, 'state_list'=>$state_list, 'city_list'=>$city_list]);
            endif;
            //Get using current country
        elseif(isset($request->currentCountry)):
            // validate current country
            $validator = Validator::make($request->all(), [
                'currentCountry' => ['required', 'integer', 'exists:world_countries,id'],
                ]);

            if($validator->fails()):
                return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
            else:
                if ( $request->currentCountry == '67' ):
                    $state_type = 'districts';
                    $state_list = SlDistrict::select('id','name')->orderBy('name')->get();
                    $city_list = NULL;
                else:
                    $state_type = 'divisions';
                    $state_list = WorldDivision::select('id','name')->where('country_id', $request->currentCountry)->orderBy('name')->get();
                    $city_list = WorldCity::select('id','name')->where('country_id', $request->currentCountry)->orderBy('name')->get();
                endif;
                return response()->json(['status'=>'success', 'state_type'=>$state_type, 'state_list'=>$state_list, 'city_list'=>$city_list]);
            endif;
        endif;
    }

    //GET CITIES
    public function getCities(Request $request)
    {
        // Get cities using district/state
        if(isset($request->stateType)):
            // VALIDATE STATE TYPE
            $validator = Validator::make($request->all(), [
                'stateType' => ['required', Rule::in(['foreignState', 'sriLanka'])],
                'selectState' => ['nullable', 'alpha_num'],
                'selectDistrict' => ['nullable', 'alpha_num'],
            ]);

            if($validator->fails()):
                return response()->json(['status' => 'error','errors'=>$validator->errors()->all(), $request->selectState, $request->selectDistrict]);
            else:
                //GET CITIES
                if ($request->stateType == 'foreignState'):
                $city_list = WorldCity::select('id','name')->where('division_id', $request->selectState)->orderBy('name')->get();
                elseif ($request->stateType == 'sriLanka'):
                $city_list = SlCity::select('id','name')->where('district_id', $request->selectDistrict)->orderBy('name')->get();
                endif;
                return response()->json(['status'=>'success', 'city_list'=>$city_list]);
            endif;
        
        elseif(isset($request->currentStateType)):
            $validator = Validator::make($request->all(), [
                'currentStateType' => ['required', Rule::in(['foreignState', 'sriLanka'])],
                'selectCurrentState' => ['nullable', 'alpha_num'],
                'selectCurrentDistrict' => ['nullable', 'alpha_num'],
            ]);

            if($validator->fails()):
                return response()->json(['status' => 'error','errors'=>$validator->errors()->all(), $request->selectCurrentState, $request->selectCurrentDistrict]);
            else:
                //GET CITIES
                if ($request->currentStateType == 'foreignState'):
                    $city_list = WorldCity::select('id','name')->where('division_id', $request->selectCurrentState)->orderBy('name')->get();
                elseif ($request->currentStateType == 'sriLanka'):
                    $city_list = SlCity::select('id','name')->where('district_id', $request->selectCurrentDistrict)->orderBy('name')->get();
                endif;
                return response()->json(['status'=>'success', 'city_list'=>$city_list]);
            endif;
        endif;
    }

}
