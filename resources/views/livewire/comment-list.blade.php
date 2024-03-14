<div id="comments">

  @foreach ($this->comments as $comment)
    <div
      class="my-6"
      id="comment-{{ $comment->id }}"
      wire:key="comment-{{ $comment->id }}"
    >
      <x-posts.author-date
        :author="$comment->user"
        :date="$comment->created_at"
        size="small"
      />
      <p class="text-sm">{{ $comment->text }}</p>
    </div>
  @endforeach

  {{-- Pagination --}}
  <nav class="my-4">
    {{ $this->comments->onEachSide(1)->links(data: ['scrollTo' => '#comments']) }}
  </nav>
</div>
