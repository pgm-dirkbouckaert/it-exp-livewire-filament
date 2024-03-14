@props(['post'])

<article
  {{ $attributes->merge([
      'class' => 'p-4 basis-full sm:flex sm:gap-6 border border-gray-200 rounded shadow-md',
  ]) }}
>
  {{-- Image --}}
  <a href="{{ route('posts.show', $post) }}">
    <img
      {{-- src="{{ $post->image }}" --}}
      src="{{ $post->getThumbnail() }}"
      alt="post image"
      class="w-full object-cover aspect-[16/12] rounded
             max-w-screen-sm sm:min-w-[300px] sm:max-w-[320px]"
    >
  </a>
  <div class="">
    {{-- Title --}}
    <a href="{{ route('posts.show', $post) }}">
      <h2 class="mt-4 sm:mt-0 mb-2 text-2xl">{{ $post->title }}</h2>
    </a>
    {{-- Author and date --}}
    <x-posts.author-date
      :author="$post->author"
      :date="$post->created_at"
    />
    {{-- Body --}}
    <p class="my-4 ">
      <a href="{{ route('posts.show', $post) }}">
        {{ Str::limit($post->body) }}
      </a>
    </p>

    {{-- Categories and likes --}}
    <div class="flex justify-between">
      {{-- Categories --}}
      <div class="flex flex-wrap gap-2">
        @foreach ($post->categories as $category)
          <x-categories.category-badge
            wire:key="category-{{ $category->id }}"
            :category="$category"
          />
        @endforeach
      </div>
      {{-- Likes --}}
      <livewire:like-button
        :key="'like-button-' . $post->id"
        :post="$post"
        :likesCount="$post->likes_count"
      />
    </div>
  </div>
</article>
