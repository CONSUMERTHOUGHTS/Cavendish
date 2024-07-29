<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_submit_website()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/websites', [
            'title' => 'Example Website',
            'url' => 'https://example.com',
            'category_ids' => [1, 2],
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('websites', ['url' => 'https://example.com']);
    }

    #[Test]
    public function user_can_search_websites()
    {
        Website::factory()->create(['title' => 'Test Website']);

        $response = $this->getJson('/api/websites/search?query=Test');

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'Test Website']);
    }
}
