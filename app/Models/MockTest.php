<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MockTest extends Model
{
    use HasFactory;
    public function questions(): HasMany
    {
        return $this->hasMany(MockQuestion::class, 'mock_test_id', 'id');
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(AddSubject::class, 'subject_id', 'id');
    }
}
