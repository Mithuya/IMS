<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','duration', 'start_date', 'end_date'];


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
