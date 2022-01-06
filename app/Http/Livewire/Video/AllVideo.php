<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AllVideo extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';

    /*public $videos;

    public function mount(){
        $this->videos = auth()->user()->channel->video;
    }*/

    public function render()
    {
        return view('livewire.video.all-video')->with('videos', auth()->user()->channel->video()->paginate(12))->extends('layouts.app');
    }

    public function delete($id){

        //delete folder
        Storage::disk('videos')->deleteDirectory($id);

        //delete from db
        Video::where('id', $id)->delete();
        
        return back();
    }

}
