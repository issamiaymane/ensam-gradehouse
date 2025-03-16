<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_subject_assignment_id',
        'grade',
        'status',
    ];
    // Relationship to TeacherSubjectAssignment
    public function teacherSubjectAssignment(): BelongsTo
    {
        return $this->belongsTo(TeacherSubjectAssignment::class, 'teacher_subject_assignment_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function adminApprovals(): HasMany
    {
        return $this->hasMany(AdminApproval::class);
    }
}
