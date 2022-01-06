<div>
    <div class="d-flex align-items-center">
        <img src="{{ asset('images/' . auth()->user()->channel->image) }}" class="rounded-circle" style="height: 40px;">
        <input type="text" wire:model="body" class="my-2 comment-form-control" placeholder="Reply to a public comment...">
    </div>

    <div class="d-flex align-items-center justify-content-end">
        @if($body)
            <a href="#" wire:click.prevent="resetForm">Cancle</a>
            <a href="#" class="mx-2 btn btn-primary" wire:click.prevent="addReply">Comment</a>
        @endif
    </div>
</div>

