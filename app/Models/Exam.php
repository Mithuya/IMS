<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'title','description', 'date_time', 'duration', 'examiner_id', 'invigilator_id'];
    protected  $primaryKey = 'id';

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function invigilator() : BelongsTo
    {
        return $this->belongsTo(Staff::class, 'invigilator_id', 'id');
    }

    public function examiner() : BelongsTo
    {
        return $this->belongsTo(Staff::class, 'examiner_id', 'id');
    }

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'exam_student');
    }
}
