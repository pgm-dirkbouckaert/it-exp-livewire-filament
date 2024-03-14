<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
  public Post $post;
  public $likesCount;

  /**
   * Toggle the like
   */
  public function toggleLike()
  {
    if (!Auth::check()) {
      // return $this->redirect(route('login'));
      return $this->dispatch('openModalLogin');
    }

    // Get user
    $user = User::find(Auth::id());

    // If user has already liked the post, unlike it (= detach the like)
    if ($user->hasLiked($this->post)) {
      $user->likes()->detach($this->post->id);
      $this->likesCount--;
      return;
    }

    // Else, like the post (= attach the like). 
    $user->likes()->attach($this->post->id);
    $this->likesCount++;
  }

  /**
   * Render the component
   */
  public function render()
  {
    return view('livewire.like-button');
  }
}
