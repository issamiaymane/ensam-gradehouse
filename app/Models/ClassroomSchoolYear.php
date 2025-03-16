<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassroomSchoolYear extends Model
{
    use HasFactory;

    protected $table = 'classroom_school_year';

    protected $fillable = [
        'classroom_id',
        'school_year',
    ];

    public function classroomStudents()
    {
        return $this->hasMany(ClassroomStudent::class);
    }

    // Relationship to Classroom
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function classroomSubjects()
    {
        return $this->hasMany(ClassroomSubject::class, 'classroom_school_year_id');
    }
}
