<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'dob', 'gender','nic', 'address'];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses() : BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function exams() : BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_student')->withPivot('result');;
    }
}
