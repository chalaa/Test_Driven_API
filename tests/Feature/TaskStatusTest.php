<?php

namespace Tests\Feature;

use App\Models\TodoList;
use App\Models\TodoListTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_a_task_status_changed(): void
    {
        $this->authUser();
        $task = TodoListTask::factory()->create();

        $this->patchJson(route("task.update",$task->id),["status"=>TodoListTask::STARTED,"title"=>$task->title]);

        $this->assertDatabaseHas("todo_list_tasks",["id"=>$task->id , "status"=>TodoListTask::STARTED]);
    }
}
