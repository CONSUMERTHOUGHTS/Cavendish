<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Run the database migrations
        $this->artisan('migrate');

        // Seed the database
        $this->artisan('db:seed');

        // Additional setup can be added here
    }

    /**
     * Tear down the test environment.
     */
    protected function tearDown(): void
    {
        // Clean up after the test
        Artisan::call('migrate:reset');

        parent::tearDown();
    }

    /**
     * Create a user and return its instance.
     *
     * @param array $attributes
     * @return \App\Models\User
     */
    public function createUser(array $attributes = [])
    {
        return \App\Models\User::factory()->create($attributes);
    }

    /**
     * Create a website and return its instance.
     *
     * @param array $attributes
     * @return \App\Models\Website
     */
    public function createWebsite(array $attributes = [])
    {
        return \App\Models\Website::factory()->create($attributes);
    }

    /**
     * Sign in a user.
     *
     * @param \App\Models\User|null $user
     * @return \App\Models\User
     */
    public function signIn($user = null)
    {
        $user = $user ?: $this->createUser();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    /**
     * Helper method to send a POST request.
     *
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Testing\TestResponse
     */
    public function postJson($uri, array $data = [], array $headers = [], $options = 0)
    {
        return $this->json('POST', $uri, $data, $headers, $options);
    }

    /**
     * Helper method to send a GET request.
     *
     * @param string $uri
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Testing\TestResponse
     */
    public function getJson($uri, array $headers = [], $options = 0)
    {
        return $this->json('GET', $uri, [], $headers, $options);
    }
}
