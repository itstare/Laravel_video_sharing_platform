@foreach($comment->replies as $reply)
<div class="media my-3" style="margin-left: 30px;">
  <img class="mr-3" src="{{ asset('images/' . $reply->user->channel->image) }}" alt="Generic placeholder image">
  <div class="media-body">
    <h5 class="mt-0">
        {{ $reply->user->name }}
        <small class="text-muted" style="font-size: 10px;">{{ $reply->created_at->diffForHumans() }}</small>
    </h5>
    {{ $reply->body }}
  </div>
</div>
@endforeach