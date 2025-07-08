<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MockTestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mock_test_id',
        'score',
        'total_marks',
        'attempt_date',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }
}
