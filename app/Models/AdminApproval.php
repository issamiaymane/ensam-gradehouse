<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'admin_id',
        'status',
        'comment',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime', // Cast reviewed_at as a Carbon instance
    ];

    /**
     * Get the grade associated with this approval.
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the admin who reviewed this grade.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
