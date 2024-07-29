<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a specific test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users
        User::factory(10)->create();

        // Create categories
        $categories = Category::factory(5)->create();

        // Create websites and associate them with categories
        Website::factory(50)->create()->each(function ($website) use ($categories) {
            $website->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Optionally create votes for websites
        $users = User::all();
        $websites = Website::all();

        foreach ($users as $user) {
            $user->votes()->create([
                'website_id' => $websites->random()->id,
            ]);
        }
    }
}
