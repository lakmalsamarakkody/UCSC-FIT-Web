<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Learning extends Controller
{
    public function index(){
        return view('website/learning');
    }
}
