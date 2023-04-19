<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\TodoListTask;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_belongs_to_a_todo_list(): void
    {
        $list = TodoList::factory()->create();
        $task = TodoListTask::factory()->create(["todo_list_id"=> $list->id]);

        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}
