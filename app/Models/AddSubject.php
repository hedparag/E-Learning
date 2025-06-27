<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AddSubject extends Model
{
   use HasFactory;

   public function subCategories(): HasMany
   {
       return $this->hasMany(AddSubject::class, 'parent_id', 'id');
   }
   public function classes()
{

    return $this->belongsToMany(
        StudentClass::class,
        'class_subject_models',
        'subject_id',        // FK on pivot for this model
        'class_id'           // FK on pivot for related model
    );
}

}
