<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'due_date', 'priority', 'is_completed','is_focus', 'pomodoro_start', 'pomodoro_duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
