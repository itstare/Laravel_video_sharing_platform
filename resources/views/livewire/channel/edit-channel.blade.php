<div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Channel</div>

                <div class="card-body">
                    @if($channel->image)
                        <img src="{{ asset('images' . '/' . $channel->image) }}" class="img-responsive" style="width:300px;height: auto;">
                    @endif

                    <form wire:submit.prevent="update">
    
                        @if(Session::has('channel_update'))
                            <div class="alert alert-success">
                                {{ session('channel_update') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Channel Name</label>
                            <input type="text" class="form-control" wire:model="channel.name">
                        </div>
                        @error('channel.name')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                        
                        <div class="form-group">
                            <label for="description">Channel Description</label>
                            <textarea class="form-control" cols="30" rows="4" wire:model="channel.description"></textarea>
                        </div>
                        @error('channel.description')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="image">Channel Image</label>
                            <input type="file" class="form-control" wire:model="image">
                        </div>
                        @error('image')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror

                        @if($image)
                        <div class="form-group">
                            Photo preview:
                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail">
                        </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </div>

                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

</div>
