<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Anouncements;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){

        $anouncements = Anouncements::orderBy('created_at', 'desc')->take(6)->get();

        return view('website/home', [
            'anouncements'=>$anouncements,
            'title' => 'Home'
        ]);
    }
}
