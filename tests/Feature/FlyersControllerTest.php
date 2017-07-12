<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class FlyersControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_show_the_form_to_create_flyer()
    {
        $user = factory(User::class)->create();
        //$user = 'foo';
        $response = $this->actingAs($user)
                    ->get('flyers/create');
        $response->assertStatus(200);
        // $this->visit('flyers/create');
    }
}
