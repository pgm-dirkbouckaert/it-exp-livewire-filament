<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $randomDate = fake()->dateTimeBetween('-10 weeks', 'now');

    return [
      'user_id' => User::all()->random()->id,
      'image' => fake()->imageUrl(640, 480),
      'title' => fake()->sentence(),
      'slug' => fake()->slug(3),
      'body' => fake()->paragraphs(10, true),
      'featured' => fake()->boolean(10),
      'created_at' => $randomDate,
      'updated_at' => $randomDate,
    ];
  }
}
