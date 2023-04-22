<?php

namespace App\Models;

use App\Models\Lable;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        "status",    
        "description",
        "lable_id"
    ];

    Public function todo_list():BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

    public function lable():BelongsTo
    {
        return $this->belongsTo(Lable::class);
    }
}