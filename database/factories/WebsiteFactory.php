<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WebsiteFactory extends Factory
{
    protected $model = \App\Models\Website::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'url' => $this->faker->url,
        ];
    }
}
