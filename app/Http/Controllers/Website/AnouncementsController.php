<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Anouncements;
use Illuminate\Http\Request;

class AnouncementsController extends Controller
{
    public function index(){

        $announcements = Anouncements::orderBy('created_at', 'desc')->where('published', 1)->get();
        return view('website.announcements', [
            'announcements'=>$announcements,
            'title' => 'Announcements'
        ]);
    }

    public function viewAnnouncement($id)
    {
        $title = "Announcement";
        $announcement = Anouncements::where('id', $id)->first();
        return view('website.announcement.announcement', compact('announcement', 'title'));
    }
}
