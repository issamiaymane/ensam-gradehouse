<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'level_year',
        'school_year',
    ];


    // Define the relationship with the Major model
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
