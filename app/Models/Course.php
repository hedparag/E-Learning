<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
   function chapters():HasMany{
     return $this->hasMany(Chapter::class,'course_id','id');
   }
   function teacher():BelongsTo{
    return $this->belongsTo(User::class,'teacher_id','id');
   }
}
