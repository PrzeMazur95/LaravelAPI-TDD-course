<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_new_label()
    {
        $this->authUser();
        
        $this->postJson(route('label.store', ['title'=>'my label', 'color' => 'red']))->assertCreated();
        $this->databaseHas('labels',['title'=>'my label', 'color' => 'red']);
    }
}
