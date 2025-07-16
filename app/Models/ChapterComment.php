<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterComment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'teacher_id', 'chapter_id', 'subject', 'message'];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }
}
