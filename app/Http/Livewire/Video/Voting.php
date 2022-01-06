<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use App\Models\Video;
use App\Models\Like;
use App\Models\Dislike;

class Voting extends Component
{
    public $video;
    public $likes;
    public $dislikes;
    public $likeActive;
    public $dislikeActive;

    protected $listeners = ['load_values' => '$refresh'];

    public function mount(Video $video){
        $this->video = $video;
        $this->checkIfLiked();
        $this->checkIfDisliked();
    }

    public function checkIfLiked(){
        $this->video->doesUserLikeVideo() ? $this->likeActive = true : $this->likeActive = false;
    }

    public function checkIfDisliked(){
        $this->video->doesUserDislikeVideo() ? $this->dislikeActive = true : $this->dislikeActive = false;
    }

    public function like(){
        //check if user likes video
        if($this->video->doesUserLikeVideo()){
            //remove like from User
            Like::where('user_id', auth()->user()->id)->where('video_id', $this->video->id)->delete();
            $this->likeActive = false;
        }else{
            //create record
            $this->video->like()->create([
                'user_id' => auth()->user()->id,
                'video_id' => $this->video->id,
            ]);
            $this->likeActive = true;
            $this->disableDislike();
        }

        $this->emit('load_values');
    }

    public function dislike(){
        //check if user dislikes video
        if($this->video->doesUserDislikeVideo()){
            //remove dislike from User
            Dislike::where('user_id', auth()->user()->id)->where('video_id', $this->video->id)->delete();
            $this->dislikeActive = false;
        }else{
            //create record
            $this->video->dislike()->create([
                'user_id' => auth()->user()->id,
                'video_id' => $this->video->id,
            ]);
            $this->dislikeActive = true;
            $this->disableLike();
        }

        $this->emit('load_values');
    }

    public function disableLike(){
        Like::where('user_id', auth()->user()->id)->where('video_id', $this->video->id)->delete();
        $this->likeActive = false;
    }

    public function disableDislike(){
        Dislike::where('user_id', auth()->user()->id)->where('video_id', $this->video->id)->delete();
        $this->dislikeActive = false;
    }

    public function render()
    {
        $this->likes = $this->video->like->count();
        $this->dislikes = $this->video->dislike->count();
        return view('livewire.video.voting')->extends('layouts.app');
    }
}
