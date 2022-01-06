




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Video</div>

                <div class="card-body" @if($this->video->processing_percentage < 100) wire:poll @endif>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="thumbnail_img">Thumbnail Image</label>
                            <img src="{{ asset($this->video->thumbnail) }}" class="img-thumbnail"/>
                        </div>

                        <div class="col-md-4">
                            <label for="proccessing_percentage">Proccessing Video</label>
                            <h5>{{ $this->video->processing_percentage }}%</h5>
                        </div>
                    </div>
                    <form wire:submit.prevent="update">
    
                        @if(Session::has('video_update'))
                            <div class="alert alert-success">
                                {{ session('video_update') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="title">Video Title</label>
                            <input type="text" class="form-control" wire:model="video.title">
                        </div>
                        @error('video.title')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                        
                        <div class="form-group">
                            <label for="description">Video Description</label>
                            <textarea class="form-control" cols="30" rows="4" wire:model="video.description"></textarea>
                        </div>
                        @error('video.description')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="visibility">Video Visibility</label>
                            <select class="form-control" wire:model="video.visibility">
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                                <option value="unlisted">Unlisted</option>
                            </select>
                        </div>
                        @error('video.visibility')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>