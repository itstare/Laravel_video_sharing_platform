<div>
    @foreach($video->comments as $comment)
        <div class="media my-3" x-data="{open: false, openReply: false}">
          <img class="mr-3 rounded-circle" src="{{ asset('images/' . $comment->user->channel->image) }}" alt="Generic placeholder image">
          <div class="media-body">
            <h5 class="mt-0">
                {{ $comment->user->name }}
                <small class="text-muted" style="font-size: 10px;">{{ $comment->created_at->diffForHumans() }}</small>
            </h5>
            {{ $comment->body }}

            @auth
            <p class="mt-3"><a href="" @click.prevent="openReply = !openReply" class="text-muted">Reply</a></p>
            <div style="margin-left: 30px;" x-show="openReply">
                @livewire('comment.new-reply', ['comment' => $comment])
            </div>
            @endauth
            @if($comment->replies->count())
            <a href="" @click.prevent="open = !open">{{ $comment->replies->count() }} replies</a>
            <div x-show="open">
                @livewire('comment.replies', ['comment' => $comment])
            </div>
            @endif
          </div>
        </div>
    @endforeach
</div>
