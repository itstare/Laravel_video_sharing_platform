<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Video;

class NewComment extends Component
{
    public $video;
    public $body;

    public function mount(Video $video){
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.comment.new-comment')->extends('layouts.app');
    }

    public function resetForm(){
        $this->body = "";
    }

    public function addComment(){
        auth()->user()->comments()->create([
            'user_id' => auth()->user()->id,
            'video_id' => $this->video->id,
            'body' => $this->body,
        ]);
        $this->body = "";

        //emit comment created
        $this->emit('commentCreated');
    }
}
