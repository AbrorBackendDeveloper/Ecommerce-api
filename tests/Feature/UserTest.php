<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_barcha_userlar_olib_kelinyapti(): void
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);

        $response->assertJson([
            'data' => true
        ]);
    }
}
