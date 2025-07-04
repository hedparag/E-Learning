<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    function lessons():HasMany{
        return $this->hasMany(Lesson::class,'chapter_id','id');
    }
}
