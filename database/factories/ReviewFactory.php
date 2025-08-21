<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_name' => $this->faker->name(),
            'image'     => $this->faker->imageUrl(640, 480, 'people'),
            'rating'    => $this->faker->numberBetween(1, 5),
            'comment'   => $this->faker->sentence(10),
        ];
    }
}
