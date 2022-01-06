<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use App\Models\Video;
use App\Models\Channel;
use Livewire\WithFileUploads;
use App\Jobs\CreateThumbnailFromVideo;
use App\Jobs\ConvertVideoForStreaming;

class CreateVideo extends Component
{
    use withFileUploads;

    public Video $video;
    public Channel $channel;
    public $videoFile;

    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:150000',

    ];

    public function mount(Channel $channel){
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.create-video')->extends('layouts.app');
    }

    public function fileCompleted(){
        //validation 
        $this->validate();

        //save file
        $path = $this->videoFile->store('videos-temp');

        //make a record in db
        $this->video = $this->channel->video()->create([
            'title' => 'Untitled',
            'slug' => str_random(20),
            'description' => 'None',
            'visibility' => 'private',
            'path' => explode('/', $path)[1],
        ]);

        //dispatch jobs
        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        //redirect to edit video route
        return redirect()->route('video.edit', ['channel' => $this->channel, 'video' => $this->video,]);
    }

    /*public function upload(){
        $this->validate([
            'videoFile' => 'required|mimes:mp4|max:150000',
        ]);
    }*/
}
