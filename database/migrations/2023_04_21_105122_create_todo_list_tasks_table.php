<?php

use App\Models\TodoListTask;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todo_list_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("todo_list_id")->constrained()->cascadeOnDelete();
            $table->foreignId("lable_id")->nullable()->constrained();
            $table->string("title");
            $table->string("status")->default(TodoListTask::NOT_STARTED);
            $table->text("description")->nullable();
            $table->timestamps();
            
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
