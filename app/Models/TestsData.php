<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'result',
        'test_id',
        'user_id',
        'patient_id'
    ];

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
