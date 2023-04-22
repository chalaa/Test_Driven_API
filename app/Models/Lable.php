<?php

namespace App\Models;

use App\Models\TodoListTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lable extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "color" ,
        "user_id"
    ];
    
    public function task():HasMany
    {
        return $this->hasMany(TodoListTask::class);
    }
}
