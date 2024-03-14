@props(['author', 'date', 'size' => 'medium'])

@php
  switch ($size) {
      case 'large':
          $textSize = 'text-lg';
          $avatarSize = 'w-12 h-12';
          break;
      case 'medium':
          $textSize = 'text-base';
          $avatarSize = 'w-10 h-10';
          break;
      case 'small':
          $textSize = 'text-sm';
          $avatarSize = 'w-8 h-8';
          break;
  }
@endphp

<div {{ $attributes->merge(['class' => 'my-2 flex items-center justify-between']) }}>
  <div class="flex gap-2 items-center">
    <img
      src=" {{ Avatar::create($author->name)->toBase64() }}"
      alt="author avatar"
      class="{{ $avatarSize }}"
    >
    <span class="{{ $textSize }} text-gray-600">{{ $author->name }}</span>
  </div>
  <span class="{{ $textSize }} text-gray-600">
    {{ $date->diffForHumans() }}
  </span>
</div>
