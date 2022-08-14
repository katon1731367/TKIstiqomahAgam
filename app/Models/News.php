<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use SebastianBergmann\CodeUnit\FunctionUnit;

class News extends Model
{
   use HasFactory, Sluggable;

   protected $guarded = ['id'];

   public function getRouteKeyName()
   {
      return 'slug';
   }

   /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
   public function sluggable(): array
   {
      return [
         'slug' => [
            'source' => 'title'
         ]
      ];
   }

   public function category()
   {
      return $this->belongsTo(CategoryNews::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function scopeFilter($query, array $filters)
   {
      $query->when($filters['search'] ?? false, function ($query, $search) {
         return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
               ->orWhere('body', 'like', '%' . $search . '%');
         });
      });

      $query->when($filters['category'] ?? false, function ($query, $category) {
         return $query->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
         });
      });
   }
}
