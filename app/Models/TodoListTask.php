<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TodoListTask extends Model
{
    use HasFactory;

    public const NOT_STARTED = "not_started";
    public const STARTED = "started";
    public const PENDING = "pending";
    public const COMPLETED = "completed";

    protected $fillable = [
        "title",
        "todo_list_id",
        "status" 
    ];

    Public function todo_list():BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

}
