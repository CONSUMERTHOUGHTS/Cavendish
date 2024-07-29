<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_delete_website()
    {
        $admin = User::factory()->create();
        // Assign role using a package like spatie/laravel-permission
        // Here we simulate admin role by setting a property for testing
        $admin->is_admin = true;
        $admin->save();

        $website = Website::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson("/api/websites/{$website->id}");

        $response->assertStatus(200);
        $this->assertDeleted($website);
    }
}
