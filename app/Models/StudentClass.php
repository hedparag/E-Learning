<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
use HasFactory;
public function subjects(){
    return $this->belongsToMany(
        AddSubject::class,      // related model
        'class_subject_models',     // pivot table
        'class_id',          // FK on pivot for this model
        'subject_id'         // FK on pivot for related model
    );
}
}
