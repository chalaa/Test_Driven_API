<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lable;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_has_many_todo_lists(){

        $user = User::factory()->create();
        $todoList = TodoList::factory()->create(["user_id"=>$user->id]);

        $this->assertInstanceOf(TodoList::class, $user->todo_lists->first());
    }

    public function test_user_has_many_lable():void{
        $user = User::factory()->create();
        $todoList = Lable::factory()->create(["user_id"=>$user->id]);

        $this->assertInstanceOf(Lable::class, $user->lable->first());
    }
}
