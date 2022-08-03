<?php

namespace App\Http\Controllers;

use App\Models\CategoryNews;
use App\Http\Controllers\Controller;

class CategoryNewsController extends Controller
{
   public function index () {
      return view('pages.news.list_news_category', [
        "title" => "List Category",
        "listCategoryNews" => CategoryNews   ::all()
      ]);
   }

   public function show($slug){
      $categoryNews = CategoryNews::where('slug', $slug)->first();

      return view ('pages.news.news_category', [
         "title" => "Category ",
         "categoryNews" => $categoryNews
      ]);
   }
}
