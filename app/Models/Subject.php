<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'code',
        'name',
    ];

    // Relationship to ClassroomSubject
    public function classroomSubjects() {
        return $this->hasMany(ClassroomSubject::class, 'subject_id');
    }

}
