<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // Create admin user
    // ----------------
    User::factory()->create([
      'name' => 'Tim Timmers',
      'email' => 'tim@example.com',
      'password' => bcrypt('artevelde')
    ]);

    // Create random users
    // -------------------
    User::factory(20)->create();

    // Create random posts
    // -------------------
    Post::factory(100)->create();

    // Create categories
    // -----------------
    $this->call(CategorySeeder::class);

    // Create random comments
    // -------------------
    Comment::factory(300)->create();

    // Create random category_post entries
    // -----------------------------------
    // Truncate table
    Schema::disableForeignKeyConstraints();
    DB::table('category_post')->delete();
    Schema::enableForeignKeyConstraints();

    // Create records
    $posts = Post::all();
    foreach ($posts as $post) {
      // First entry
      $randomDate = fake()->dateTimeBetween('-10 weeks', '+1 week');
      $randomCategoryId = Category::all()->random()->id;
      $this->createCategoryPostEntry($randomCategoryId, $post->id, $randomDate);

      // Second entry
      $randomDate = fake()->dateTimeBetween('-10 weeks', '+1 week');
      $secondRandomCategoryId = Category::all()->random()->id;
      if ($secondRandomCategoryId != $randomCategoryId) {
        $this->createCategoryPostEntry($secondRandomCategoryId, $post->id, $randomDate);
      }
    }
  }

  /**
   * Create category_post entry
   *
   * @param [type] $categoryId
   * @param [type] $postId
   * @param [type] $randomDate
   * @return void
   */
  public function createCategoryPostEntry($categoryId, $postId, $randomDate): void
  {
    DB::table('category_post')->insert([
      'category_id' => $categoryId,
      'post_id' => $postId,
      'created_at' => $randomDate,
      'updated_at' => $randomDate,
    ]);
  }
}
