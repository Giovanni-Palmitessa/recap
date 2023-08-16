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
}
