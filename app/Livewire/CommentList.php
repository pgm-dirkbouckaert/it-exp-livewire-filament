<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class CommentList extends Component
{
  use WithPagination;

  public Post $post;

  public int $perPage = 3;

  #[Computed()]
  public function comments()
  {
    return Comment::latest()
      ->with('user', 'post')
      ->where('post_id', $this->post->id)
      ->paginate($this->perPage);
  }


  public function render()
  {
    return view('livewire.comment-list');
  }
}
