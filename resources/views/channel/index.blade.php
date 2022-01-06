@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary">
	<div class="container">
		<h1 class="display-4">{{ $channel->name }}</h1>
		<p class="lead">{{ $channel->description }}
			@if(auth()->user()->id === $channel->user_id)
			<a href="{{ route('channel.edit', $channel) }}" class="btn btn-secondary">Edit</a>
			@endif
		</p>

	</div>
</div>

<div class="container">
	<div class="d-flex align-items-center">
		<img src="{{ asset('images/' . $channel->image) }}" class="rounded-circle mr-3" height="130px">
		<div>
			<h3>{{ $channel->name }}</h3>
			<p>{{ $channel->subscribers() }} Subscribers</p>
		</div>
	</div>	
</div>

<div class="container">

<div class="row my-4">
	@foreach($channel->video as $video)

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
</div>
</div>
@endsection