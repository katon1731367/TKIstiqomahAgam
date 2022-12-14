<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
         'title' => $this->faker->sentence(mt_rand(2,8)),
         'slug' => $this->faker->slug(),
         'excerpt' => $this->faker->paragraph(),
         'body' => $this->faker->paragraph(mt_rand(5,10)),
         'category_id' => 1,
         'user_id' => 1,
     ];
    }
}
