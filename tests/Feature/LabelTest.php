<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Label;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->user=$this->authUser();
        
    }

    public function test_user_can_create_new_label()
    {
        $label = Label::factory()->raw();
        $this->authUser();

        $this->postJson(route('label.store'), $label)->assertCreated();
        $this->assertDatabaseHas('labels',['title'=>$label['title'], 'color' => $label['color']]);
    }

    public function test_user_can_delete_label()
    {
        $label = $this->createLabel();

        $this->deleteJson(route('label.destroy', $label))->assertNoContent();
        $this->assertDatabaseMissing('labels', ['title'=>$label['title'], 'color' => $label['color']]);
    }

    public function test_user_can_update_label()
    {
        $label = $this->createLabel();

        $this->patchJson(route('label.update', $label), ['title'=>'updated title', 'color'=>'updated color'])->assertOk();
        $this->assertDatabaseHas('labels', ['title'=>'updated title', 'color' =>'updated color']);
    }

    public function test_fetch_all_label_for_a_user()
    {
        $label = $this->createLabel(['user_id' => $this->user->id]);
        $this->createLabel();

        $response = $this->getJson(route('label.index'))->assertOk()->json();

        $this->assertEquals($response[0]['title'], $label->title);
    }


}
