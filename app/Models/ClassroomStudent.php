<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassroomStudent extends Model
{
    use HasFactory;

    protected $table = 'classroom_student';

    protected $fillable = [
        'classroom_school_year_id',
        'student_id',
    ];

    // Relationship to Student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relationship to ClassroomSchoolYear
    public function classroomSchoolYear(): BelongsTo
    {
        return $this->belongsTo(ClassroomSchoolYear::class, 'classroom_school_year_id');
    }

    // Relationship to Grades
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'student_id');
    }
}
