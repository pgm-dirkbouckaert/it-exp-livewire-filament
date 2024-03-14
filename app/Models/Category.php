<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'text_color',
    'bg_color',
  ];

  /******************************************************
   * RELATIONS
   ******************************************************/
  /**
   * The posts that belong to the Category
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class);
  }
}