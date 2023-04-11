<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\TodoListTask;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    private $task;
    private $todo_list;
    public function setUp(): void
    {
        parent::setUp();
        $this->task = TodoListTask::factory()->create();
        $this->todo_list = TodoList::factory()->create();
    }
    public function test_fetch_all_task_of_todo_list(): void
    {
        
        $response = $this->getJson(route("todo-list.task.index",$this->todo_list->id))->assertOk()->json();
        $this->assertEquals($this->task->title,$response[0]["title"]);
    }

    public function test_store_task_for_todo_list(): void{

        $list = TodoListTask::factory()->make();
        $response = $this->postJson(route("todo-list.task.store",$this->todo_list->id),["title"=>$list->title])
            ->assertCreated()
            ->json();
        $this->assertEquals($list->title,$response["title"]);
        $this->assertDatabaseHas("todo_list_tasks",["title"=>$list->title]);

    }

    public function test_delete_task_for_todo_list() : void{

        $this->deleteJson(route("task.destroy", $this->task->id))
             ->assertNoContent();
            
        $this->assertDatabaseMissing("todo_list_tasks",["title"=>$this->task->title]);
    }

    public function test_update_task_for_todo_list() : void{

        $this->patchJson(route("task.update", $this->task->id),["title"=>"updated task"])
             ->assertOk();
            
        $this->assertDatabaseHas("todo_list_tasks",["id"=>$this->task->id,"title"=>"updated task"]);
    }
}
