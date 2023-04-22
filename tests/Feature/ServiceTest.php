<?php

namespace Tests\Feature;

use Google\Client;
use Tests\TestCase;
use App\Models\Service;
use App\Models\TodoListTask;
use Mockery\MockInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{

    use RefreshDatabase;
    private $user;

    public function setUp(): void{

        parent::setUp();

        $this->user = $this->authUser();

    }

    
    public function test_a_user_can_connect_to_service_and_token_is_stored(): void
    {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {
            $mock->shouldReceive('setScopes')->once();
            $mock->shouldReceive('createAuthUrl')->andReturn("http://localhost");
        });

        $response = $this->getJson(route("service.connect", "google-drive"))
        ->assertOk()
        ->json();

        $this->assertEquals($response["url"],"http://localhost");
        $this->assertNotNull($response["url"]);
    }

    public function test_service_callback_will_store_token()
    {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {

            $mock->shouldReceive('fetchAccessTokenWithAuthCode')->andReturn(["access_token"=>"fake token"]);

        });

        $response = $this->postJson(route("service.callback"),["code"=>"dummy code"])->assertCreated();
        $this->assertDatabaseHas("services",["user_id"=>$this->user->id]);

    }

    public function test_date_can_be_stored_on_google_drive()
    {
        TodoListTask::factory()->create(["created_at"=> now()->subDays(2)]);
        TodoListTask::factory()->create(["created_at"=> now()->subDays(5)]);
        TodoListTask::factory()->create(["created_at"=> now()->subDays(4)]);
        TodoListTask::factory()->create(["created_at"=> now()->subDays(3)]);

        TodoListTask::factory()->create(["created_at"=> now()->subDays(8)]);

        $mock = $this->mock(Client::class, function (MockInterface $mock) {
            $mock->shouldReceive('setAccessToken');
            $mock->shouldReceive('getLogger->info');
            $mock->shouldReceive('shouldDefer');
            $mock->shouldReceive('execute');
        });

        $service = Service::factory()->create();
        $this->postJson(route("service.store",$service->id))->assertCreated();
    }
}
