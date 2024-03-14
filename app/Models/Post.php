<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'image',
    'title',
    'slug',
    'body',
    'featured',
  ];

  /******************************************************
   * HELPERS
   ******************************************************/

  /**
   * Get the thumbnail of the post
   *
   * @return void
   */
  public function getThumbnail()
  {
    return str_contains($this->image, 'http')
      ? $this->image
      // : asset('storage/images/posts/' . $this->image);
      : Storage::url($this->image);
  }

  /******************************************************
   * SCOPES
   ******************************************************/

  /**
   * Search scope
   */
  public function scopeSearch($query, $search = '')
  {
    return $query->where('title', 'like', '%' . $search . '%');
  }

  /**
   * Scope a query to only include popular posts.
   */
  public function scopePopular($query)
  {
    // https://laravel.com/docs/10.x/eloquent-relationships#counting-related-models
    return $query->withCount('likes')->orderBy('likes_count', 'desc');
  }

  /**
   * Scope a query to only include posts with a specific category
   */
  public function scopeWithCategory($query, string $category)
  {
    return $query->whereHas('categories', function ($query) use ($category) {
      $query->where('slug', $category);
    });
  }

  /******************************************************
   * RELATIONS
   ******************************************************/

  /**
   * Get the author that owns the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Get all of the categories for the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function categories(): BelongsToMany
  {
    return $this->belongsToMany(Category::class);
  }

  /**
   * The likes that belong to the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function likes(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'post_like')
      ->withTimestamps();
  }

  /**
   * Get all of the comments for the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }
}
