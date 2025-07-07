<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockSettings extends Model
{
    use HasFactory;
    protected $fillable=['min_question','max_question','duration','total_marks','instructions','question_type'];
}
