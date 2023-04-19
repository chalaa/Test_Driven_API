<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    
    use RefreshDatabase;
    public function test_a_user_can_login_with_email_and_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route("user.login"),[
            "email" => $user->email,
            "password" => "password"
        ])->assertOk();

        $this->assertArrayHasKey("token", $response->json());
    }

    public function test_it_raise_error_if_password_is_invalid_password(){
        
        $user = User::factory()->create();

        $response = $this->postJson(route("user.login"),[
            "email" => $user->email,
            "password" => "testshs"
        ])->assertUnauthorized();

       $this->assertArrayHasKey("token", $response->json());

    }


}
