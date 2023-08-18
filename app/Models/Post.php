<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public static function slugger($title) {
        // generare lo slug base
       $base_slug = Str::slug($title);
       $i = 1;
       $slug = $base_slug;

       while (Post::where('slug', $slug)->get()) {
        $slug = $base_slug. '-' . $i;
        $i++;
       }
    }
}
