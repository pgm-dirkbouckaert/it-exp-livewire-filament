@props(['category'])

<a
  {{ $attributes->merge([
      'class' => 'bg-red-600 text-white rounded-xl px-3 py-1 text-sm hover:opacity-75',
  ]) }}
  wire:navigate
  href="{{ route('home', ['category' => $category->slug]) }}"
  style="background-color: {{ $category->bg_color }}; color: {{ $category->text_color }};"
>
  {{ $category->title }}
</a>
