<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','duration', 'start_date', 'end_date'];


    public function subjects() : HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
