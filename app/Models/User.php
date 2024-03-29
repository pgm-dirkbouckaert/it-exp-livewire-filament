<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /******************************************************
   * RELATIONS
   ******************************************************/

  /**
   * Get all of the posts for the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  /**
   * Get all of the comments for the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }

  /**
   * The likes that belong to the User
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function likes(): BelongsToMany
  {
    return $this->belongsToMany(Post::class, 'post_like')
      ->withTimestamps();
  }

  /**
   * Check if the user has liked a post
   *
   * @param Post $post
   * @return boolean
   */
  public function hasLiked(Post $post)
  {
    return $this->likes()->where('post_id', $post->id)->exists();
  }
}
