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


    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject');
    }
}
