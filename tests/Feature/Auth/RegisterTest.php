<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    
    use RefreshDatabase;

    public function test__a_user_can_register(): void
    {
        $this->postJson(route("user.register"),
        [
            "name" => "chala", 
            "email" => "chala@test.com",
            "password"=>"testshs",
            "password_confirmation"=>"testshs",
        ])->assertCreated();
        $this->assertDatabaseHas("users",["name" => "chala", "email" => "chala@test.com"]);
    }
}
