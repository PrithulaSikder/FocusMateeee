<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'habit_name',
        'habit_date',
        'is_completed',
    ];

    // Relationship: A habit belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
