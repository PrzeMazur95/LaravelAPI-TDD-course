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
        $this->authUser();
        
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
        
    }


}
