<?php

namespace App\Http\Controllers;

use App\Models\TeamSales;
use App\Models\TeamSalesGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
   private $view_page = '.pages.admin.user_menu';
   private $USER_ROLE_0 = 'Admin';
   private $USER_ROLE_1 = 'Kepala Sekolah';
   private $USER_ROLE_2 = 'Guru';
   private $USER_ROLE_3 = 'Staff';

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $page = $this->view_page . '/index';
      $userRole = [$this->USER_ROLE_0, $this->USER_ROLE_1, $this->USER_ROLE_2, $this->USER_ROLE_3];

      $data = [
         'title' => 'User List',
         'sidebar_title' => 'user_menu',
         'user_role' => $userRole
      ];

      return view($page, $data);
   }

   /**
    * Get listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function fetchUser()
   {
      $users = User::get();

      foreach ($users as $user) {
         if ($user->user_role === 0) {
            $user->user_role = $this->USER_ROLE_0;
         } else if ($user->user_role === 1) {
            $user->user_role = $this->USER_ROLE_1;
         } else if ($user->user_role === 2) {
            $user->user_role = $this->USER_ROLE_2;
         } else if ($user->user_role === 3) {
            $user->user_role = $this->USER_ROLE_3;
         }
      }

      if (request()->ajax()) {
         return datatables()->of($users)
            ->addColumn('aksi', function ($data) {
               $button = " <button class='detail btn btn-primary' id='" . $data->username . "' data-bs-toggle='modal' id='detailUser' data-bs-target='#modalDetailUser'>" . self::getBadgeWithIcon('svg/eye.svg') . "</button>";
               if (Auth::user()->user_role == 0) {
                  $button .= " <button class='edit btn btn-warning' id='" . $data->username . "' >" . self::getBadgeWithIcon('svg/edit.svg') . "</button>";
                  $button .= " <button class='delete btn btn-danger' id='" . $data->username . "'>" . self::getBadgeWithIcon('svg/x-circle.svg') . "</button>";
               }
               return $button;
            })
            ->rawColumns(['aksi'])
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
      // we dont show form becoz form already show in index page
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $rules = [
         'name' => 'required|max:255',
         'username' => 'required|unique:users|max:255',
         'email' => 'required|unique:users|email|max:255',
         'no_handphone' => 'required|unique:users|Numeric',
         'password' => 'required|min:8|max:255',
         'user_role' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
         $data = [
            'status' => 'danger',
            'message' => $validator->errors()->toArray()
         ];

         return $data;
      }

      $validated = $request->validate($rules);

      //hashing password
      $validated['password'] = Hash::make($validated['password']);

      if ($validated['user_role'] === $this->USER_ROLE_0) {
         $validated['user_role'] = 0;
      } else if ($validated['user_role'] === $this->USER_ROLE_1) {
         $validated['user_role'] = 1;
      } else if ($validated['user_role'] === $this->USER_ROLE_2) {
         $validated['user_role'] = 2;
      } else if ($validated['user_role'] === $this->USER_ROLE_3) {
         $validated['user_role'] = 3;
      }

      // //saving user to database
      User::create($validated);

      $data = [
         'status' => 'success',
         'message' => 'User <b>' . $validated['name'] . '</b>, successfully added!'
      ];

      return $data;
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function show(User $user)
   {
      if ($user->user_role === 0) {
         $user->user_role = $this->USER_ROLE_0;
      } else if ($user->user_role === 1) {
         $user->user_role = $this->USER_ROLE_1;
      } else if ($user->user_role === 2) {
         $user->user_role = $this->USER_ROLE_2;
      } else if ($user->user_role === 3) {
         $user->user_role = $this->USER_ROLE_3;
      }
      return $user;
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function edit(User $user)
   {
      if ($user->user_role === 0) {
         $user->user_role = $this->USER_ROLE_0;
      } else if ($user->user_role === 1) {
         $user->user_role = $this->USER_ROLE_1;
      } else if ($user->user_role === 2) {
         $user->user_role = $this->USER_ROLE_2;
      } else if ($user->user_role === 3) {
         $user->user_role = $this->USER_ROLE_3;
      }

      return $user;
   }

   /**
    * save the password for userd.
    *
    * @param  \App\Models\User  $user
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function storePassword(User $user, Request $request)
   {
      $rules = [
         'password' => 'required',
         'repeat_password' => 'required|same:password'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
         $data = [
            'status' => 'danger',
            'message' => $validator->errors()->toArray()
         ];

         return $data;
      }

      $data = $request->validate($rules);

      //hashing password
      $validated['password'] = Hash::make($data['password']);

      User::where('id', $user->id)
         ->update($validated);

      $data = [
         'status' => 'success',
         'message' => 'Password user <b>' . $user->username . '</b>, successfully updated!'
      ];

      return $data;
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, User $user)
   {
      $rules = [
         'name' => 'required|max:255',
         'user_role' => 'required',
         'username' => 'required',
         'email' => 'required',
         'no_handphone' => 'required',
      ];

      if ($request->username != $user->username) {
         $rules['username'] .= '|unique:users|max:255';
      }

      if ($request->email != $user->email) {
         $rules['email'] .= '|unique:users|email|max:255';
      }

      if ($request->no_handphone != $user->no_handphone) {
         $rules['no_handphone'] .= '|unique:users|Numeric';
      }

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
         $data = [
            'status' => 'danger',
            'message' => $validator->errors()->toArray()
         ];

         return $data;
      }

      $validated = $request->validate($rules);

      $count_admin = User::where('user_role', 0)->count();

      if ($user->user_role === 0) {
         if ($count_admin === 1) {
            $data = [
               'status' => 'danger',
               'message' => 'this user is the <b>last admin</b>'
            ];

            return $data;
         }
      }

      if ($validated['user_role'] === $this->USER_ROLE_0) {
         $validated['user_role'] = 0;
      } else if ($validated['user_role'] === $this->USER_ROLE_1) {
         $validated['user_role'] = 1;
      } else if ($validated['user_role'] === $this->USER_ROLE_2) {
         $validated['user_role'] = 2;
      } else if ($validated['user_role'] === $this->USER_ROLE_3) {
         $validated['user_role'] = 3;
      }

      User::where('username', $user->username)
         ->update($validated);

      $data = [
         'status' => 'success',
         'message' => 'User <b>' . $user->name . '</b>, successfully updated!'
      ];

      return $data;
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
   public function destroy(User $user)
   {
      $countAdmin = User::where('user_role', 0)->count();
      if ($user->user_role === 0) {
         if ($countAdmin === 1) {
            $data = [
               'status' => 'danger',
               'message' => 'this user is the <b>last admin</b>'
            ];

            return $data;
         }
      }
      User::destroy($user->id);

      $data = [
         'status' => 'success',
         'message' => 'Successfully delete user name <b>' . $user->name . '</b> !'
      ];

      return $data;
   }

   /**
    * Export all user data from storage.
    *
    * @return excel file excel
    */
   public function exportIntoExcel()
   {
      return Excel::download(new UsersExport, 'users-export.xlsx');
   }
}
