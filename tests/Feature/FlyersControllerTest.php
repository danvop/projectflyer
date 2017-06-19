<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyersControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_show_the_form_to_create_flyer()
    {
        $response = $this->get('flyers/create');
        $response->assertStatus(200);
        // $this->visit('flyers/create');
    }
}
