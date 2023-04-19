<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\TodoListTask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;

class TodoListTest extends TestCase
{
    /**
     * A basic unit test example.
     */     

    use RefreshDatabase;
    

    public function test_a_todo_list_can_have_many_tasks(): void
    {
        
        $list = TodoList::factory()->create();
        $task = TodoListTask::factory()->create(["todo_list_id"=> $list->id]);

        $this->assertInstanceOf(Collection::class, $list->tasks);
        $this->assertInstanceOf(TodoListTask::class, $list->tasks->first());
    }

    public function test_if_todo_list_is_deleted_its_task_also_deleted():void
    {
        $list = TodoList::factory()->create();
        $task = TodoListTask::factory()->create(["todo_list_id"=> $list->id]);
        $task2 = TodoListTask::factory()->create();

        $list->delete();

        $this->assertDatabaseMissing("todo_lists",["id"=>$list->id]);
        $this->assertDatabaseMissing("todo_list_tasks",["id"=>$task->id]);
        $this->assertDatabaseHas("todo_list_tasks",["id"=>$task2->id]);

    }
}
