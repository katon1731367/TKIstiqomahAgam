<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class DashboardNewsController extends Controller
{
   private $view_page = '.pages.admin.news_menu';

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $page = $this->view_page . '/index';

      $data = [
         'title' => 'Daftar Berita',
         'sidebar_title' => 'news_menu',
         'news' => News::get()
      ];

      return view($page, $data);
   }

   /**
    * Get listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function fetchNews()
   {
      $news = News::with('user', 'category')->select('news.*');;

      if (request()->ajax()) {
         return datatables()->of($news)
            ->addColumn('updated_at', function ($data) {
               return "" . $data->updated_at . "";
            })
            ->addColumn('category_name', function ($data) {
               $button = " <button class='badge bg-secondary' id='" . $data->category->slug . "' >" . $data->category->name . "</button>";
               return $button;
            })
            ->addColumn('aksi', function ($data) {
               $button = " <a class='edit btn btn-warning' href='news/" . $data->slug . "/edit' >" . self::getBadgeWithIcon('svg/edit.svg') . "</a> ";
               $button .= " <a class='edit btn btn-primary' href='news/" . $data->slug . "' >" . self::getBadgeWithIcon('svg/eye.svg') . "</a> ";
               $button .= " <button class='delete btn btn-danger' id='" . $data->slug . "' >" . self::getBadgeWithIcon('svg/x-circle.svg') . "</button> ";
               return $button;
            })
            ->rawColumns(['category_name', 'updated_at', 'aksi'])
            ->make(true);
      }
   }

   public function getBadgeWithIcon($string)
   {
      return "<img src='" . asset($string) . "' style='width: 1em' class='mb-1'>";
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $page = $this->view_page . '/create_news';

      $data = [
         'title' => 'Buat Berita Baru',
         'sidebar_title' => 'news_menu',
         'categories_news' => CategoryNews::all()
      ];

      return view($page, $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\News  $news
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request, News $news)
   {
      $page = $this->view_page . '/edit_news';
      $data = [
         'title' => 'Edit Berita"' . $news->title . '"',
         'sidebar_title' => 'news_menu',
         'categories_news' => CategoryNews::all(),
         'news' => $news
      ];

      return view($page, $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\News  $news
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $validatedData = $request->validate([
         'title' => 'required|max:255',
         'slug' => 'required|unique:news|max:255',
         'body' => 'required',
         'category_id' => 'required'
      ]);

      $validatedData['user_id'] = auth()->user()->id;
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 255);

      News::create($validatedData);

      return redirect('/dashboard/news')
         ->with('success', 'Berita dengan Judul ' . $validatedData['title'] . ', Berhasil ditambahkan!');
   }

   /**
    * save the password for userd.
    *
    * @param  \App\Models\News  $news
    * @return \Illuminate\Http\Response
    */
   public function show(News $news)
   {
      $page = $this->view_page . '/news';
      $data = [
         'title' => $news->title,
         'sidebar_title' => 'news_menu',
         'news' => $news
      ];

      return view($page, $data);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\News  $news
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, News $news)
   {
      $rules = [
         'title' => 'required|max:255',
         'body' => 'required',
         'category_id' => 'required'
      ];

      if ($request->slug != $news->slug) {
         $rules['slug'] = 'required|unique:news|max:255';
      }

      $validatedData = $request->validate($rules);

      $validatedData['user_id'] = auth()->user()->id;
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 255);

      News::where('slug', $request->slug)
         ->update($validatedData);

      return redirect('/dashboard/news')
         ->with('success', 'Berita dengan Judul ' . $validatedData['title'] . ', Berhasil diperbaharui!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\News  $news
    * @return \Illuminate\Http\Response
    */
   public function destroy(News $news)
   {
      News::destroy($news->id);

      return redirect('/dashboard/news')
         ->with('success', 'Berita dengan Judul ' . $news['title'] . ', Berhasil dihapus!');
   }
   
   public function destroyByAjax(News $news)
   {
      News::destroy($news->id);

      $data = [
         'status' => 'success',
         'message' => 'Behasil menghapus berita dengan judul <b>' . $news->title . '</b> !'
      ];

      return $data;
   }

   public function checkSlug(Request $request)
   {
      $slug = SlugService::createSlug(News::class, 'slug', $request->title);
      return response()->json(['slug' => $slug]);
   }
}
