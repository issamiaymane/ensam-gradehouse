<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'subject_id',
    ];

    /**
     * Get the teacher associated with the assignment.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the subject associated with the assignment.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
