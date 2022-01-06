<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($videos->count())
                @foreach($videos as $video)

                    <div class="card my-2">
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-md-2">
                                    <a href="{{ route('video.watch', $video) }}">
                                        <img src="{{ asset($video->Thumbnail) }}" class="img-thumbnail">
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <h5>{{ $video->title }}</h5>
                                    <p class="text-truncate">{{ $video->description }}</p>
                                </div>

                                <div class="col-md-2">
                                    {{ $video->visibility }}
                                </div>

                                <div class="col-md-2">
                                    {{ $video->created_at->format('d/m/Y') }}
                                </div>

                                @if(Auth::user()->channel->id === $video->channel_id)
                                <div class="col-md-2">
                                    <a href="{{ route('video.edit', ['channel' => auth()->user()->channel, 'video' => $video->slug]) }}" class="btn btn-light btn-sm">Edit</a>
                                    <a wire:click.prevent="delete({{ $video->id }})" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                @endforeach
                @else
                <h1>You didn't upload any videos. <a href="{{ route('video.create', Auth::user()->channel) }}" class="link-info">Start uploading now!</a></h1>
                @endif
            </div>
                <div class="d-flex"><div class="mx-auto">{{ $videos->links() }}</div></div>
        </div>
    </div>
</div>
