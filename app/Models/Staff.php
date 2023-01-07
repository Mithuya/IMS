<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'dob', 'gender','nic', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_staff');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
