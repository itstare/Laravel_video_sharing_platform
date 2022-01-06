@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{  route('search') }}" method="GET">
        <div class="d-flex align-items-center my-2">
            <input type="text" name="query" class="form-control" placeholder="Search">
            <button type="submit" class="search-btn"><i class="material-icons">search</i></button>
        </div>
    </form>

    <div class="row my-3">
        @isset($channels)
        @foreach($channels as $channelVideos)
        @foreach($channelVideos->video as $video)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('video.watch', $video) }}" class="card-link">
                    <div class="card mb-4" style="width:333px;border: none;">
                        <div style="position: relative;">
                            <img class="card-img-top" src="{{ asset($video->thumbnail) }}" alt="card image" style="width:333px;height:174px;">
                            <div class="badge badge-dark" style="position: absolute;bottom: 8px;right: 16px;">{{ $video->duration }}</div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/' . $video->channel->image) }}"
                                style="height:40px;" class="rounded-circle">
                                <h4 class="ml-3">{{ $video->title }}</h4>

                            </div>
                            <p class="gray-text mt-4 font-weight-bold" style="line-height: 0.2px;">{{ $video->channel->name }}</p>
                            <p class="gray-text font-weight-bold" style="line-height:0.2px;">{{ $video->views }} views . {{ $video->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @endforeach
        @endisset
        @isset($videos)
        @foreach($videos as $video)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('video.watch', $video) }}" class="card-link">
                    <div class="card mb-4" style="width:333px;border: none;">
                        <div style="position: relative;">
                            <img class="card-img-top" src="{{ asset($video->thumbnail) }}" alt="card image" style="width:333px;height:174px;">
                            <div class="badge badge-dark" style="position: absolute;bottom: 8px;right: 16px;">{{ $video->duration }}</div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/' . $video->channel->image) }}"
                                style="height:40px;" class="rounded-circle">
                                <h4 class="ml-3">{{ $video->title }}</h4>

                            </div>
                            <p class="gray-text mt-4 font-weight-bold" style="line-height: 0.2px;">{{ $video->channel->name }}</p>
                            <p class="gray-text font-weight-bold" style="line-height:0.2px;">{{ $video->views }} views . {{ $video->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @endisset
    </div>
</div>

@endsection