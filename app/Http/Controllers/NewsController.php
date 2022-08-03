<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
   public function index () {
      return view('pages.news.news', [
        "title" => "News",
        "posts" => News::all()
      ]);
   }

   public function show(News $news){
      return view ('pages.news.show_news', [
         "title" => "News",
         "post" => $news
      ]);
   }
}
