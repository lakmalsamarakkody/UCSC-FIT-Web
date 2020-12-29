<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Anouncements;
use Illuminate\Http\Request;

class AnouncementsController extends Controller
{
    public function index(){

        $anouncements = Anouncements::orderBy('created_at', 'desc')->get();
        return view('website/announcements', [
            'announcements'=>$anouncements,
            'title' => 'Announcements'
        ]);
    }
}
