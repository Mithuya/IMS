<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['subject_id', 'title','description', 'date-time', 'duration', 'examiner', 'invigilator'];
    protected  $primaryKey = 'id';

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function invigilator()
    {
        return $this->belongsTo(Staff::class, 'invigilator_id', 'id');
    }

    public function examiner()
    {
        return $this->belongsTo(Staff::class, 'examiner_id', 'id');
    }
}
