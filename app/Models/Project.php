<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'image_id',
        'user_id'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function image(): HasOne
    {
        return $this->hasOne(Image::class,'id','image_id');
    }
    
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'project_id','id')->orderBy('id','desc');
    }
   
    public function timeSpent(): HasManyThrough
    {
        return $this->hasManyThrough(TimeSpent::class,Task::class,'id','task_id');
    }
    
}
