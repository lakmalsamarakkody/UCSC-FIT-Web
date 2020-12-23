<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Flag;
use Illuminate\Http\Request;

use App\Models\Student\Title;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\Support\WorldCity;
use App\Models\Support\WorldCountry;
use App\Models\Support\WorldDivision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical;

class RegistrationController extends Controller
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
    //$this->middleware('registration.check');
    // $this->middleware('student.auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $user = Auth::user();
    $student = NULL;
    if(Student::where('user_id', $user->id)->first()):
      $student = Student::where('user_id', $user->id)->first();
    endif;
    $student_titles = Title::select('title')->get();
    $countries_list = WorldCountry::orderBy('name')->get();
    return view('portal/student/registration', [
      'student_titles' => $student_titles,
      'countries_list' => $countries_list,
      'student' => $student,
    ]);
  }

  //Validate SaveInfoButton Request
  public function saveInfoValidator(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [            
      // 'email'=> ['required', 'email', 'unique:users'],
      'title' => ['nullable', 'exists:titles,title'],
      'firstName' => ['nullable', 'alpha','min:3'],
      'middleNames' => ['nullable', 'alpha_dash_space'],
      'lastName' => ['nullable', 'alpha', 'min:3'],
      'fullName' => ['nullable', 'alpha_dash_space'],
      'initials' => ['nullable', 'alpha_capital'],
      'dob' => ['nullable' , 'date','before:today'],
      'gender' => ['nullable', Rule::in(['Male', 'Female'])],
      'citizenship' => ['nullable', Rule::in(['Sri Lankan', 'Foreign National'])],
      'uniqueType' => ['nullable', Rule::in(['nic', 'postal', 'passport'])],
      'qualification' => ['required', Rule::in(['degree', 'higherdiploma', 'diploma', 'advancedlevel', 'ordinarylevel', 'otherqualification'])],

      'house' => ['nullable', 'address'],
      'addressLine1' => ['nullable', 'address'],
      'addressLine2' => ['nullable', 'address'],
      'addressLine3' => ['nullable', 'address'],
      'addressLine4' => ['nullable', 'address'],
      'city' => ['nullable', 'numeric'],
      'selectDistrict' => ['nullable', 'numeric'],
      'selectState' => ['nullable', 'exists: world_divisions,id'],
      'country' => ['nullable', 'exists:world_countries,id'],

      'currentHouse' => ['nullable', 'address'],
      'currentAddressLine1' => ['nullable', 'address'],
      'currentAddressLine2' => ['nullable', 'address'],
      'currentAddressLine3' => ['nullable', 'address'],
      'currentAddressLine4' => ['nullable', 'address'],
      'currentCity' => ['nullable', 'numeric'],
      'selectCurrentDistrict' => ['nullable', 'numeric'],
      'selectCurrentState' => ['nullable', 'exists: world_divisions,id'],
      'currentCountry' => ['nullable', 'exists: world_countries,id'],
      
      'telephoneCountryCode' => ['nullable', 'numeric', 'digits_between:1,5' ],
      'telephone' => ['nullable', 'numeric', 'digits_between:8,15'],
      'email' => ['nullable', 'email', 'unique:users'],
      'designation' => ['nullable', 'regex:/^[a-zA-Z\s]*$/', 'min:3'],
    ]);

    if($request->uniqueType == 'nic'):
      if(strlen($request->unique_id)>10):
        $uniqueID_validator =  Validator::make($request->all(), [
          'unique_id' => ['nullable', 'numeric', 'digits:12'],
        ]);
      else:
        $uniqueID_validator =  Validator::make($request->all(), [
          'unique_id' => ['nullable', 'alpha_num', 'min:10', 'regex:/^([0-9]{9}[x|X|v|V])$/'],
        ]);
      endif;
    elseif($request->uniqueType == 'postal'):
      $uniqueID_validator =  Validator::make($request->all(), [
        'unique_id' => ['nullable', 'alpha_num', 'size:10'],
      ]);
    else:
      $uniqueID_validator =  Validator::make($request->all(), [
        'unique_id' => ['nullable', 'alpha_num', 'size:10'],
      ]);
    endif;
    
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    elseif(isset($uniqueID_validator) && $uniqueID_validator->fails()):
      return response()->json(['errors'=>$uniqueID_validator->errors()]);
    else:
        return response()->json(['success'=>'success']);
    endif;
  }

  //SAVE INFORMATION
  public function saveInfo(Request $request){
    $user = Auth::user();
    //UPDATE DETAILS IF STUDENT EXISTS
    if(Student::where('user_id', $user->id)->first()):
      $student = Student::where('user_id',$user->id)->first();
      $student->user_id = $user->id;
      $student->title = $request->title;
      $student->first_name = $request->firstName;
      $student->middle_names = $request->middleNames;
      $student->last_name = $request->lastName;
      $student->initials = $request->initials;
      $student->full_name = $request->fullName;
      $student->dob = $request->dob;
      $student->gender = $request->gender;
      $student->citizenship = $request->citizenship;
      $student->education = $request->qualification;

      $student->permanent_house = $request->house;
      $student->permanent_address_line1 = $request->addressLine1;
      $student->permanent_address_line2 = $request->addressLine2;
      $student->permanent_address_line3 = $request->addressLine3;
      $student->permanent_address_line4 = $request->addressLine4;
      $student->permanent_city_id = $request->city;
      $student->permanent_country_id = $request->country;

      $student->current_house = $request->currentHouse;
      $student->current_address_line1 = $request->currentAddressLine1;
      $student->current_address_line2 = $request->currentAddressLine2;
      $student->current_address_line3 = $request->currentAddressLine3;
      $student->current_address_line4 = $request->currentAddressLine4;
      $student->current_city_id = $request->currentCity;
      $student->current_country_id = $request->currentCountry;

      $student->telephone_country_code = $request->telephoneCountryCode;
      $student->telephone = $request->telephone;

      // CHECK UNIQUE ID AND SAVE TO RELEVANT FIELD
      if($request->uniqueType == 'nic'):
        if(strlen($request->unique_id)==10):
          $student->nic_old = $request->unique_id;
          $student->nic_new = NULL;
          $student->postal = NULL;
          $student->passport = NULL;
        elseif(strlen($request->unique_id)==12):
          $student->nic_new = $request->unique_id;
          $student->nic_old = NULL;
          $student->postal = NULL;
          $student->passport = NULL;
        endif;
      elseif($request->uniqueType == 'postal'):
        $student->postal = $request->unique_id;
        $student->nic_old = NULL;
        $student->nic_new = NULL;
        $student->passport = NULL;
      elseif($request->uniqueType == 'passport'):
        $student->passport = $request->unique_id;
        $student->nic_old = NULL;
        $student->nic_new = NULL;
        $student->postal = NULL;
      endif;

      // CHECK EMPLOYMENT
      if ($request->employement == 'yes'):
        $student->designation = $request->designation;
      else:
        $student->designation = NULL;
      endif;

      //CREATE STUDENT RECORD
      $student->save();

      return response()->json(['status'=>'success', 'student'=>$student]);

    // CREATE NEW STUDENT RECORD
    else:
      $student = new Student;
      $student->user_id = $user->id;
      $student->title = $request->title;
      $student->first_name = $request->firstName;
      $student->middle_names = $request->middleNames;
      $student->last_name = $request->lastName;
      $student->initials = $request->initials;
      $student->full_name = $request->fullName;
      $student->dob = $request->dob;
      $student->gender = $request->gender;
      $student->citizenship = $request->citizenship;
      $student->education = $request->qualification;

      $student->permanent_house = $request->house;
      $student->permanent_address_line1 = $request->addressLine1;
      $student->permanent_address_line2 = $request->addressLine2;
      $student->permanent_address_line3 = $request->addressLine3;
      $student->permanent_address_line4 = $request->addressLine4;
      $student->permanent_city_id = $request->city;
      $student->permanent_country_id = $request->country;

      $student->current_house = $request->currentHouse;
      $student->current_address_line1 = $request->currentAddressLine1;
      $student->current_address_line2 = $request->currentAddressLine2;
      $student->current_address_line3 = $request->currentAddressLine3;
      $student->current_address_line4 = $request->currentAddressLine4;
      $student->current_city_id = $request->currentCity;
      $student->current_country_id = $request->currentCountry;

      $student->telephone_country_code = $request->telephoneCountryCode;
      $student->telephone = $request->telephone;

      // CHECK UNIQUE ID AND SAVE TO RELEVANT FIELD
      if($request->uniqueType == 'nic'):
        if(strlen($request->unique_id)==10):
          $student->nic_old = $request->unique_id;
        elseif(strlen($request->unique_id)==12):
          $student->nic_new = $request->unique_id;
        endif;
      elseif($request->uniqueType == 'postal'):
        $student->postal = $request->unique_id;
      elseif($request->uniqueType == 'passport'):
        $student->passport = $request->unique_id;
      endif;

      // CHECK EMPLOYMENT
      if ($request->employement == 'yes'):
        $student->designation = $request->designation;
      endif;

      //CREATE STUDENT RECORD
      $student->save();

      // CREATE STUDENT FLAG RECORD
      $student_flag = new Flag;
      $student_flag->student_id = $student->id;
      $student_flag->save();
      return response()->json(['status'=>'success', 'student'=>$student, 'flag'=>$student_flag]);
    endif;
  }

  public function getCountries(Request $request)
  {
    // validate citizenship
    $validator = Validator::make($request->all(), [
      'citizenship' => ['required', 'alpha_space'],
    ]);

    if($validator->fails()):
        return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
    else:
      if ( $request->citizenship == 'Sri Lankan' ):
        $countries_list = WorldCountry::select('id','name')->where('name', 'Sri Lanka')->orderBy('name')->get();
      elseif ( $request->citizenship == 'Foreign National' ):
        $countries_list = WorldCountry::select('id','name')->where('name', '!=', 'Sri Lanka')->orderBy('name')->get();
      endif;
      return response()->json(['status'=>'success', 'country_list'=>$countries_list ]);
    endif;
  }

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
