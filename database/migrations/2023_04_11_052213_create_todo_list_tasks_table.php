<?php

use App\Models\TodoListTask;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todo_list_tasks', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->unsignedBigInteger("todo_list_id");
            $table->string("status")->default(TodoListTask::NOT_STARTED);
            $table->timestamps();
            $table->foreign("todo_list_id")
            ->references("id")
            ->on("todo_lists")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_list_tasks');
    }
};
