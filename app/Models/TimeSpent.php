<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSpent extends Model
{
    use HasFactory;
    
    protected $table = 'tasks_time_spent';
    
    protected $fillable = [
        'description',
        'task_id',
        'time_spent'
    ];
}
