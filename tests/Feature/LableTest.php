<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LableTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    private $lable;
    private $authUser;
    public function setUp(): void
    {
        parent::setUp();
        $this->authUser = $this->authUser();
        $this->lable = Lable::factory()->create(["user_id"=>$this->authUser->id]);
    }

    public function test_user_can_fetch_all_lable(): void{
        Lable::factory()->create();
        $response = $this->getJson(route("lable.index"));

        $this->assertEquals(1, count($response->json()));
    }

    public function test_user_can_create_new_lable(): void
    {
        
        $lable = Lable::factory()->raw();
        $this->postJson(route("lable.store"),$lable)->assertCreated();

        $this->assertDatabaseHas("lables",["title"=> $lable["title"],"color"=>$lable["color"]]);
    }

    public function test_user_can_delete_lable(): void{

        $deleted_lable = Lable::factory()->create();
        
        $this->deleteJson(route("lable.destroy",$deleted_lable->id))->assertNoContent();

        $this->assertDatabaseMissing("lables",["id"=>$deleted_lable->id]);
    }

    public function test_user_can_update_lable(): void {

        $this->putJson(route("lable.update",$this->lable->id),
            [
                "title"=>"lable updated",
                "color"=>"green"
            ]
        )->assertOk();

        $this->assertDatabaseHas("lables",[
            "id"=>$this->lable->id,
            "title"=>"lable updated",
            "color"=>"green"
        ]);
    }
}
