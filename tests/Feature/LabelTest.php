<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Label;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_new_label()
    {
        $label - Label::factory()->raw();
        $this->authUser();

        $this->postJson(route('label.store'), $label)->assertCreated();
        $this->assertDatabaseHas('labels',['title'=>$label->title, 'color' => $label->color]);
    }
}
