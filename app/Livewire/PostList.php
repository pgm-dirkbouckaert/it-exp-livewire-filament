<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PostList extends Component
{
  use WithPagination;

  #[Url()]
  public $sortOrder = 'desc';

  #[Url()]
  public $search = '';

  #[Url()]
  public $category = '';

  /**
   * Get the active category (computed property)
   *
   * @return void
   */
  #[Computed()]
  public function activeCategory()
  {
    if ($this->category === '' || $this->category === null) {
      return null;
    }
    return Category::where('slug', $this->category)->first();
  }

  /**
   * Clear the filters
   *
   * @return void
   */
  public function clearFilters()
  {
    $this->reset('category', 'search');
    $this->resetPage(); // Reset pagination
  }


  /**
   * Get the posts (computed property)
   *
   * @return void
   */
  #[Computed()]
  public function posts()
  {
    return Post::latest()
      ->with('author', 'categories')
      ->withCount('likes')
      ->when($this->activeCategory, function ($query) {
        $query->withCategory($this->category); // scope op Model Post
      })
      ->search($this->search) // scope op Model Post
      // ->orderBy('created_at', $this->sortOrder)
      ->paginate(3);
  }

  /**
   * Render the component
   *
   * @return void
   */
  public function render()
  {
    return view('livewire.post-list', [
      'categories' => Category::all(),
    ]);
  }
}
