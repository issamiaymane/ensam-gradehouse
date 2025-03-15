<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassroomSubject extends Model
{
    use HasFactory;

    protected $table = 'classroom_subject';

    protected $fillable = [
        'classroom_school_year_id',
        'subject_id',
        'subject_code',
        'semester',
    ];

    // Relationship to Subject
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Relationship to ClassroomSchoolYear
    public function classroomSchoolYear(): BelongsTo
    {
        return $this->belongsTo(ClassroomSchoolYear::class, 'classroom_school_year_id');
    }

    // Relationship to Grades
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'teacher_subject_assignment_id', 'id');
    }

    // Relationship to TeacherSubjectAssignments
    public function teacherSubjectAssignments(): HasMany
    {
        return $this->hasMany(TeacherSubjectAssignment::class, 'classroom_subject_id');
    }

}
