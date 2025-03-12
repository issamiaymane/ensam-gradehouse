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
        'name',  // make sure it's mass assignable
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    // Define the accessor for `name`
    public function getNameAttribute()
    {
        $major_name = $this->major->code;
        $level = '';

        switch ($this->level_year) {
            case 'first':
                $level = '1';
                break;
            case 'second':
                $level = '2';
                break;
            case 'third':
                $level = '3';
                break;
            default:
                $level = '';
                break;
        }

        return strtoupper($major_name . $level);
    }

}

