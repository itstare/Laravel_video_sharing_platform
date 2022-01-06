<div class="my-5">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/' . $channel->image) }}" class="rounded-circle">
            <div class="ml-2">
                <h4>{{ $channel->name }}</h4>
                <p class="gray-text text-sm">{{ $channel->subscribers() }} @if($channel->subscribers() === 1)subscriber @else subscribers @endif</p>
            </div>
        </div>

        <div>
            <button class="btn btn-lg text-uppercase @if($isSubscribed)btn-secondary @else btn-danger @endif" wire:click.prevent="toggle">@if($isSubscribed)Subscribed @else Subscribe @endif</button>
        </div>
    </div>
</div>
