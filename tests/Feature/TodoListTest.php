<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\TodoListTask;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    private $list;
    private $authUser;
    public function setUp():void{

        parent::setUp();
        $this->authUser= $this->authUser();
        $this->list = Todolist::factory()->create([
            "name"=>"test",
            "user_id"=>$this->authUser->id
        ]);
    }

    public function test_fetch_all_todo_list(): void
    {
        Todolist::factory()->create();
        $response = $this->getJson(route("todo-list.index"))->json("data");
        $this->assertEquals(1, count($response));
    }

    public function test_fetch_single_todo_list(){

        
        $response = $this->getJson(route("todo-list.show",$this->list->id))
                    ->assertOk()
                    ->json("data");
        $this->assertEquals($response["name"],$this->list->name);
    }

    public function test_store_new_todo_list(){

        $list = TodoList::factory()->make();

        $response=$this->postJson(route("todo-list.store"),["name"=>$list->name])
                ->assertCreated()
                ->json("data");

        $this->assertEquals("$list->name",$response["name"]);
        $this->assertDatabaseHas("todo_lists",["name"=>"$list->name"]);


    }

    public function test_while_storing_todo_list_name_is_required(){

        $this->withExceptionHandling();

        $this->postJson(route("todo-list.store"))
                        ->assertUnprocessable()
                        ->assertJsonValidationErrors(["name"]);

    }

    public function test_delete_todo_list(){

        $this->deleteJson(route("todo-list.destroy",$this->list->id))->assertNoContent();

        $this->assertDatabaseMissing("todo_lists",["id" => $this->list->id]);
    }

    public function test_update_todo_list_(){

        $this->patchJson(route("todo-list.update" , $this->list->id),["name"=>"list is updated"])
            ->assertOk()->json("data");

        $this->assertDatabaseHas("todo_lists",["id"=>$this->list->id, "name"=>"list is updated"]);

    }

    public function test_while_updating_todo_list_name_is_required(){

        $this->withExceptionHandling();

        $this->patchJson(route("todo-list.update",$this->list->id))
                        ->assertUnprocessable()
                        ->assertJsonValidationErrors(["name"]);
    }
}
