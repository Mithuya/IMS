<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','title','description','duration'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'subject_staff');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
