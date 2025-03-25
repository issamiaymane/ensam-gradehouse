<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherSubjectAssignment extends Model
{
    use HasFactory;

    protected $table = 'teacher_subject_assignment';

    protected $fillable = [
        'teacher_id',
        'classroom_subject_id',
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function classroomSubject(): BelongsTo
    {
        return $this->belongsTo(ClassroomSubject::class, 'classroom_subject_id');
    }




    // Relationship to Subject (via ClassroomSubject)
    public function subject()
    {
        return $this->through('classroomSubject')->has('subject');
    }

    // Relationship to School Year (via ClassroomSubject -> ClassroomSchoolYear)
    public function schoolYear()
    {
        return $this->through('classroomSubject')->has('classroomSchoolYear');
    }

}
