<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    // Relationship to TeacherSubjectAssignment
    public function teacherSubjectAssignment(): BelongsTo
    {
        return $this->belongsTo(TeacherSubjectAssignment::class, 'teacher_subject_assignment_id');
    }
}
