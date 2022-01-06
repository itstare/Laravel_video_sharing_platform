@section('css')
<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
@endsection

@section('scripts')
<script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
@endsection
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="video-container" wire:ignore>
                <video controls preload="auto" id="video-ply" class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered" data-setup="{}" poster="{{ asset('videos/' . $video->id . '/' . $video->thumbnail_img) }}">
                    <source src="{{ asset('videos/' . $video->id . '/' . $video->processed_file) }}" type="application/x-mpegURL">

                    <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mt-4">{{ $video->title }}</h3>
                                <p class="gray-text">{{ $video->views }} views . {{ $video->UploadDate }}</p>
                            </div>

                            <div>
                                @livewire('video.voting', ['video' => $video])
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col-md-12">
                        @livewire('channel.channel-info', ['channel' => $video->channel])
                    </div>
                </div>
            </div>
            <hr>
            <h4>{{ $video->comments->count() }} Comments</h4>
            @auth
            @livewire('comment.new-comment', ['video' => $video])
            @endauth
            @livewire('comment.all-coments', ['video' => $video])
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
    
</div>

<script>
    var player = videojs('video-ply');

    player.on('timeupdate', function(){
        if(this.currentTime() > 3){
            this.off('timeupdate')
            Livewire.emit('VideoViewed')
        }
    })
</script>
