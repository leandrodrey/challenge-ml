<?php

namespace Tests\Unit\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SatelliteControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_apiConnection()
    {
        $response = $this->post('/api/v1/topsecret');
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    /*public function test_getMessage()
    {
        $response = $this->post('/api/v1/topsecret');
        $response->json($this->post());
    } */
}
