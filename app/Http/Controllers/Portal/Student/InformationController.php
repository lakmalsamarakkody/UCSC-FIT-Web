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
        //Validate data
        $update_contact_details_validator = Validator::make($request->all(), [
            'house' => ['required', 'address'],
            'addressLine1' => ['required', 'address'],
            'addressLine2' => ['nullable', 'address'],
            'addressLine3' => ['nullable', 'address'],
            'addressLine4' => ['nullable', 'address'],
            'city' => ['nullable', 'numeric'],
            'selectDistrict' => ['nullable'],
            'selectState' => ['nullable'],
            'country' => ['required', 'exists:world_countries,id'],

            'currentHouse' => ['nullable', 'address'],
            'currentAddressLine1' => ['nullable', 'address'],
            'currentAddressLine2' => ['nullable', 'address'],
            'currentAddressLine3' => ['nullable', 'address'],
            'currentAddressLine4' => ['nullable', 'address'],
            'currentCity' => ['nullable', 'numeric'],
            'selectCurrentDistrict' => ['nullable'],
            'selectCurrentState' => ['nullable'],
            'currentCountry' => ['nullable', 'exists:world_countries,id'],
            
            'telephoneCountryCode' => ['required', 'numeric', 'digits_between:1,5' ],
            'telephone' => ['required', 'numeric', 'digits_between:8,15'],
        ]);

        // Validate permanent address
        if($request->country == '67'):
            $update_permanent_address_validator = Validator::make($request->all(), [
                'city' => ['nullable', 'numeric', 'exists:sl_cities,id'],
                'selectDistrict' => ['required', 'numeric', 'exists:sl_districts,id'],
            ]);
        else:
            $update_permanent_address_validator = Validator::make($request->all(), [
                'city' => ['nullable', 'numeric', 'exists:world_cities,id'],
                'selectState' => ['nullable', 'numeric', 'exists:world_divisions,id'],
            ]);
        endif;
  
        // Validate current address
        if($request->current_address == true):
            $update_current_address_validator = Validator::make($request->all(), [
                'currentHouse' => ['required'],
                'currentAddressLine1' => ['required'],
                'currentCountry' => ['required'],
            ]);
            if($request->currentCountry == '67'):
            $update_current_city_validator = Validator::make($request->all(), [
                'currentCity' => ['nullable', 'numeric', 'exists:sl_cities,id'],
                'selectCurrentDistrict' => ['required', 'numeric', 'exists:sl_districts,id'],
            ]);
            else:
            $update_current_city_validator = Validator::make($request->all(), [
                'currentCity' => ['nullable', 'numeric', 'exists:world_cities,id'],
                'selectCurrentState' => ['nullable', 'numeric', 'exists:world_divisions,id'],
            ]);
            endif;
        endif;

        if($update_contact_details_validator->fails()):
            return response()->json(['errors'=>$update_contact_details_validator->errors()]);
        elseif(isset($update_permanent_address_validator) && $update_permanent_address_validator->fails()):
            return response()->json(['errors'=>$update_permanent_address_validator->errors()]);
        elseif(isset($update_current_address_validator) && $update_current_address_validator->fails()):
            return response()->json(['errors'=>$update_current_address_validator->errors()]);
        elseif(isset($update_current_city_validator) && $update_current_city_validator->fails()):
            return response()->json(['errors'=>$update_current_city_validator ->errors()]);
        else:
            // Get permanent address values
            $permanentHouse = $request->house;
            $permanentAddressLine1 = $request->addressLine1;
            $permanentAddressLine2 = $request->addressLine2;
            $permanentAddressLine3 = $request->addressLine3;
            $permanentAddressLine4 = $request->addressLine4;
            $permanentCity = $request->city;
            if($request->country != null):
                if($request->country == '67'):
                    $permanentStateId = $request->selectDistrict;
                else:
                    $permanentStateId = $request->selectState;
                endif;
            endif;
            $permanentCountry = $request->country;

            //Pemanent address array
            $permanentAddress = array('permanentHouse'=>$permanentHouse,
                'permanentAddressLine1'=>$permanentAddressLine1,
                'permanentAddressLine2'=>$permanentAddressLine2,
                'permanentAddressLine3'=>$permanentAddressLine3,
                'permanentAddressLine4'=>$permanentAddressLine4,
                'permanentCity'=>$permanentCity,
                'permanentStateId'=>$permanentStateId,
                'permanentCountry'=>$permanentCountry);

            // Get current address values
            $currentHouse = $request->currentHouse;
            $currentAddressLine1 = $request->currentAddressLine1;
            $currentAddressLine2 = $request->currentAddressLine2;
            $currentAddressLine3 = $request->currentAddressLine3;
            $currentAddressLine4 = $request->currentAddressLine4;
            $currentCity = $request->currentCity;
            if($request->currentCountry != null):
                if($request->currentCountry == '67'):
                    $currentStateId = $request->selectCurrentDistrict;
                else:
                    $currentStateId = $request->selectCurrentState;
                endif;
            else:
                $currentStateId = null;
            endif;
            $currentCountry = $request->currentCountry;

            // Current address array
            $currentAddress = array('currentHouse'=>$currentHouse,
                'currentAddressLine1'=>$currentAddressLine1,
                'currentAddressLine2'=>$currentAddressLine2,
                'currentAddressLine3'=>$currentAddressLine3,
                'currentAddressLine4'=>$currentAddressLine4,
                'currentCity'=>$currentCity,
                'currentStateId'=>$currentStateId,
                'currentCountry'=>$currentCountry);

            // Update contact details
            if(Student::where('user_id', Auth::user()->id)->update([
                'permanent_house' => $permanentAddress['permanentHouse'],
                'permanent_address_line1' => $permanentAddress['permanentAddressLine1'],
                'permanent_address_line2' => $permanentAddress['permanentAddressLine2'],
                'permanent_address_line3' => $permanentAddress['permanentAddressLine3'],
                'permanent_address_line4' => $permanentAddress['permanentAddressLine4'],
                'permanent_city_id' => $permanentAddress['permanentCity'],
                'permanent_state_id' => $permanentAddress['permanentStateId'],
                'permanent_country_id' => $permanentAddress['permanentCountry'],
                'current_house' => $currentAddress['currentHouse'],
                'current_address_line1' => $currentAddress['currentAddressLine1'],
                'current_address_line2' => $currentAddress['currentAddressLine2'],
                'current_address_line3' => $currentAddress['currentAddressLine3'],
                'current_address_line4' => $currentAddress['currentAddressLine4'],
                'current_city_id' => $currentAddress['currentCity'],
                'current_state_id' => $currentAddress['currentStateId'],
                'current_country_id' => $currentAddress['currentCountry'],
                'telephone_country_code' => $request->telephoneCountryCode,
                'telephone' => $request->telephone
            ])):
                return response()->json(['status'=>'success']);
            endif;
        endif;
        return response()->json(['error'=>'error']);
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
