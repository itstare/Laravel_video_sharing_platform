<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use App\Models\Channel;
use App\Models\Video;
use Session;

class EditVideo extends Component
{
    public Video $video;
    public Channel $channel;

    protected $rules = [
        'video.title' => 'required|max:255',
        'video.description' => 'nullable|max:1500',
        'video.visibility' => 'required|in:private,public,unlisted',
    ];

    public function mount(Channel $channel, Video $video){
        $this->channel = $channel;
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video.edit-video')->extends('layouts.app');
    }

    public function update(){
        $this->validate();

        //Insert data to db (update)
        $slug = uniqid(true) . $this->video->title;
        $this->video->update([
            'title' => $this->video->title,
            'slug' => str_slug($slug, '-'),
            'description' => $this->video->description,
            'visibility' => $this->video->visibility,
        ]);

        Session::flash('video_update', 'Video updated!');
    }
}
