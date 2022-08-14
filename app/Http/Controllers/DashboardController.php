<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolProfileHistory;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    private $view_page = 'pages.';

    public function index()
    {
        $page = $this->view_page . 'admin.dashboard';

        $schoolProfile = SchoolProfileHistory::latest()->first();
        $contactMessage = ContactMessage::all();
        $recentContactMessage = ContactMessage::orderBy('created_at')->get();

        $achievementCount = News::where('category_id', 2)->orderBy('updated_at')->get()->count();
        
        $teacherCount = Teacher::all()->count();
        $roomCount = $schoolProfile ? $schoolProfile->room_count : 0;
        $studentCount = $schoolProfile ? $schoolProfile->student_count : 0;
        $messageCount = $contactMessage->count();
        $userCount = User::all()->count();

        $news = News::all();
        $newsCount = $news->count();
        $achievementCount = $news->where('category_id', 1)->count();
        $facilityCount = $news->where('category_id', 2)->count();
        $extracurricularCount = $news->where('category_id', 3)->count();
        $featuredprogramCount = $news->whereIn('category_id', [4,5,6])->count();

        $data = [
           'title' => 'Dashboard',
           'sidebar_title' => 'dashboard',
           'achievement_count' => $achievementCount,
           'teacher_count' => $teacherCount,
           'room_count' => $roomCount,
           'student_count' => $studentCount,
           'message_count' => $messageCount,
           'user_count' => $userCount,
           'recentContactMessage' => $recentContactMessage,
           'news_count' => $newsCount,
           'achievement_count' =>  $achievementCount,
           'facility_count' => $facilityCount,
           'extracurricular_count' => $extracurricularCount,
           'featuredprogram_count' =>  $featuredprogramCount
        ];

        return view($page, $data);    
    }
}
