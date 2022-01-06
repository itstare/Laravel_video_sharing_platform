<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Comment;

class Replies extends Component
{
    public $comment;

    public function mount(Comment $comment){
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment.replies');
    }
}
