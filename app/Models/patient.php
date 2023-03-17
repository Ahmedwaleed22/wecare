<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'school_stage',
        'gender',
        'age',
        'can_read',
        'user_id',
    ];

    public function doctor() {
        return $this->belongsTo(User::class);
    }
}
