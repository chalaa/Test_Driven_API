<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TodoList;

class TodoListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    private $list;

    public function setUp():void{

        parent::setUp();
        $this->list = Todolist::factory()->create();
    }

    public function test_fetch_all_todo_list(): void
    {

        $response = $this->getJson(route("todo-list.all"));

        $this->assertEquals(1, count($response->json()));
    }

    public function test_fetch_single_todo_list(){

        
        $response = $this->getJson(route("todo-list.show",$this->list->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals($response["name"],$this->list->name);
    }

    public function test_store_new_todo_list(){
        //preparation


        //action
        $response=$this->postJson(route("todo-list.store"),["name"=>"todo-list"])
                ->assertCreated()
                ->json();

        //assertion
        $this->assertEquals("todo-list",$response["name"]);
        $this->assertDatabaseHas("todo_lists",["name"=>"todo-list"]);


    }
}
