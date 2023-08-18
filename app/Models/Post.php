<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Support\Str;
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

    public static function slugger($string) {
        // generare lo slug base
       $base_slug = Str::slug($string);
       $i = 1;
       $slug = $base_slug;

       while (self::where('slug', $slug)->first()) {
        $slug = $base_slug . '-' . $i;
        $i++;
       }
       return $slug;
    }
}
