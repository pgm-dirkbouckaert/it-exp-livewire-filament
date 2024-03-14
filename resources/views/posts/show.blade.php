<x-app-layout>

  {{-- Header --}}
  <x-slot name="header">
    <h1 class="text-3xl">{{ $post->title }}</h1>
  </x-slot>

  {{-- Image, author, date, number of comments, like button --}}
  <section class="max-w-7xl mx-auto sm:px-6 lg:px-8
                  flex flex-col sm:flex-row sm:gap-8">
    {{-- Image --}}
    <img
      {{-- src="{{ $post->image }}" --}}
      src="{{ $post->getThumbnail() }}"
      alt="post image"
      class="w-full object-cover aspect-[16/12] rounded
             max-w-screen-sm sm:min-w-[300px] sm:max-w-[375px]"
    >

    <div>
      {{-- Author and date --}}
      <x-posts.author-date
        :author="$post->author"
        :date="$post->created_at"
        class="mt-6 mb-0 sm:flex-col sm:items-start sm:justify-start sm:gap-6"
      />
      <div class="mt-4 mb-0 flex flex-col gap-4 items-end sm:items-start">
        {{-- Number of comments --}}
        <span class="text-gray-600">
          {{ $post->comments->count() }} comments
        </span>
        {{-- Like button --}}
        <livewire:like-button
          :post="$post"
          :likesCount="$post->likes->count()"
        />
      </div>
    </div>

  </section>

  {{-- Body --}}
  <section class="mt-12 mb-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          {{ $post->body }}
        </div>
      </div>
    </div>
  </section>

  {{-- Comments --}}
  <section class="mb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3>Comments</h3>
          <livewire:comment-list :post="$post" />
        </div>
      </div>
    </div>
  </section>

</x-app-layout>
