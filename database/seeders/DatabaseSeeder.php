<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      User::factory(3)->create();
      Teacher::factory(3)->create();

      User::create([
         'name' => 'Admin',
         'username' => 'admin',
         'email' => 'admin@gmail.com',
         'no_handphone' => '08116061410',
         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         'user_role' => 0,
         'email_verified_at' => now(),
         'remember_token' => Str::random(10),
      ]);

      CategoryNews::create([
         'name' => 'Fasilitas',
         'slug' => 'fasilitas'
      ]);
      
      CategoryNews::create([
         'name' => 'Extrakulikuler',
         'slug' => 'extrakulikuler'
      ]);

      CategoryNews::create([
         'name' => 'Program Unggulan',
         'slug' => 'program-unggulan'
      ]);

      CategoryNews::create([
         'name' => 'Prestasi Sekolah',
         'slug' => 'prestasi-sekolah'
      ]);

      CategoryNews::create([
         'name' => 'Prestasi Kepala Sekolah',
         'slug' => 'prestasi-kepala-sekolah'
      ]);

      CategoryNews::create([
         'name' => 'Prestasi Guru',
         'slug' => 'prestasi-guru'
      ]);

      ContactMessage::create([
         'name' => 'joni sutojo',
         'email' => 'joni.sins@gmail.com',
         'message' => 'halo saya joni'
      ]);

      ContactMessage::create([
         'name' => 'roanl sutojo',
         'email' => 'joni.ronal@gmail.com',
         'message' => 'halo saya ronal'
      ]);

      News::factory(20)->create();
   }
}
