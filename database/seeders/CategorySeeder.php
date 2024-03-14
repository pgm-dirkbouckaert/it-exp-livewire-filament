<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

  public $categories = [
    [
      'title' => 'Javascript',
      'slug' => 'javascript',
      'text_color' => 'black',
      'bg_color' => 'yellow',
    ],
    [
      'title' => 'Node.js',
      'slug' => 'node-js',
      'text_color' => 'white',
      'bg_color' => '#026e00',
    ],
    [
      'title' => 'React',
      'slug' => 'react',
      'text_color' => 'white',
      'bg_color' => '#0074a6',
    ],
    [
      'title' => 'GraphQL',
      'slug' => 'graphql',
      'text_color' => 'white',
      'bg_color' => '#f6009b',
    ],
    [
      'title' => 'NextJS',
      'slug' => 'next-js',
      'text_color' => 'white',
      'bg_color' => 'black',
    ],
    [
      'title' => 'Laravel',
      'slug' => 'laravel',
      'text_color' => 'white',
      'bg_color' => 'red',
    ],
    [
      'title' => 'PHP',
      'slug' => 'php',
      'text_color' => 'white',
      'bg_color' => 'dodgerblue',
    ],
    [
      'title' => 'Livewire',
      'slug' => 'livewire',
      'text_color' => 'white',
      'bg_color' => '#EE5D99',
    ],
    [
      'title' => 'Filament',
      'slug' => 'filament',
      'text_color' => 'black',
      'bg_color' => '#fdae4b',
    ],
    [
      'title' => 'EJS',
      'slug' => 'ejs',
      'text_color' => 'white',
      'bg_color' => '#b4ca65',
    ],
  ];


  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    foreach ($this->categories as $category) {
      Category::insert([
        'title' => $category['title'],
        'slug' => $category['slug'],
        'text_color' => $category['text_color'],
        'bg_color' => $category['bg_color'],
      ]);
    }
  }
}
