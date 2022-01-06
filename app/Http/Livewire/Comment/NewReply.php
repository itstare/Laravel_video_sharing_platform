<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Comment;

class NewReply extends Component
{
    public $comment;
    public $body;

    public function mount(Comment $comment){
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment.new-reply');
    }

    public function resetForm(){
        $this->body = "";
    }

    public function addReply(){
        $this->comment->replies()->create([
            'body' => $this->body,
            'comment_id' => $this->comment->id,
            'user_id' => auth()->user()->id,
        ]);
        $this->body = "";

        //emit reply created
        $this->emit('replyCreated');
    }
}
