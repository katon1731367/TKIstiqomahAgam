<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Models\Customer;
use App\Models\Pipeline;
use App\Models\TeamSales;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use App\Models\ProductCompany;
use App\Models\TeamSalesGroup;
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
        User::factory(40)->create();

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
            'name' => 'Extrakulikuler'
         ]);

         CategoryNews::create([
            'name' => 'Prestasi'
         ]);

         News::factory(20)->create();
    }
}
