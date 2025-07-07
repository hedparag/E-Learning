<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MockTest extends Model
{
   use HasFactory;
   public function questions():HasMany{
    return $this->hasMany(MockQuestion::class,'mock_test_id','id');
   }
}
