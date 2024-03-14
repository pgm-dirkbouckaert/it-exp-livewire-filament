<div>

  <h1 class="mb-4">Posts</h1>

  {{-- SEARCH AND FILTER --}}
  <section class="mb-8 px-3 lg:px-7">
    {{-- Clear filters --}}
    <div class="text-sm">
      @if ($this->category || $this->search)
        <button
          class="mb-4 bg-gray-200 text-xs cursor-pointer px-2 py-1 rounded hover:opacity-75"
          wire:click="clearFilters"
        >
          X
        </button>
      @endif
      {{-- Show active category --}}
      @if ($this->category)
        <span class="inline-block mx-2">Current category: <x-categories.category-badge :category="$this->activeCategory" /></span>
      @endif
      {{-- Show search query --}}
      @if ($search)
        <span class="inline-block mx-2">Searching for: <strong>{{ $search }}</strong></span>
      @endif
    </div>

    <div class="flex flex-col gap-4">
      {{-- Filter by category --}}
      <div class="flex flex-wrap gap-2">
        Filter:
        @foreach ($categories as $category)
          <x-categories.category-badge
            wire:key="filter-{{ $category->id }}"
            :category="$category"
          />
        @endforeach
      </div>
      {{-- Search --}}
      <div>
        Search: <x-text-input
          wire:model.live.debounce.300ms="search"
          placeholder="Search posts by title..."
        />
      </div>
    </div>
  </section>

  {{-- POST LIST --}}
  <section class="mb-12 flex flex-col gap-8">

    @foreach ($this->posts as $post)
      <x-posts.post-card
        :post="$post"
        wire:key="post-{{ $post->id }}"
      />
    @endforeach

  </section>

  {{-- Pagination --}}
  <nav class="my-4">
    {{ $this->posts->onEachSide(1)->links() }}
  </nav>

</div>
