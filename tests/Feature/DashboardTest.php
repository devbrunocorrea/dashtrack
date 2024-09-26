<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }
}
