<?php

namespace Tests;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    

    public function setUp(): void{
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function authUser(){
        $user = User::factory()->create();

        Sanctum::actingas($user);
        return $user;
    }
}
