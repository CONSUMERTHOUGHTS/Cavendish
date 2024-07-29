<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Website;

class VoteFactory extends Factory
{
    protected $model = \App\Models\Vote::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'website_id' => Website::factory(),
        ];
    }
}
