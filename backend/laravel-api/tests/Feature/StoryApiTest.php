<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_is_available(): void
    {
        $response = $this->get('/api/health');

        $response->assertOk();
        $response->assertJsonPath('status', 'ok');
    }
}
