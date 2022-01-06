<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Video;
use App\Livewire\Comment\NewReply;
use App\Livewire\Comment\NewComment;

class AllComents extends Component
{
    public $video;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'replyCreated' => '$refresh',
    ];

    public function mount(Video $video){
        $this->video = $video;   
    }

    public function render()
    {
        return view('livewire.comment.all-coments')->extends('layouts.app');
    }

}
