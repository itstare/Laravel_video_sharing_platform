<?php

namespace App\Http\Livewire\Channel;

use Livewire\Component;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class ChannelInfo extends Component
{
    public $channel;
    public $isSubscribed;

    public function mount(Channel $channel){
        $this->channel = $channel;
        if(Auth::check()){
        if(auth()->user()->isSubscribedTo($channel)){
            $this->isSubscribed = true;
        } else{
            $this->isSubscribed = false;
        }
        } else{
            $this->isSubscribed = false;
        }
    }

    public function render()
    {
        return view('livewire.channel.channel-info')->extends('layouts.app');
    }

    public function toggle(){
        if(!Auth::check()){
            return redirect('/login');
        }
        if(auth()->user()->isSubscribedTo($this->channel)){
            Subscription::where('user_id', auth()->user()->id)->where('channel_id', $this->channel->id)->delete();
            $this->isSubscribed = false;
        } else{
            Subscription::create([
                'user_id' => auth()->user()->id,
                'channel_id' => $this->channel->id,
            ]);
            $this->isSubscribed = true;
        }
    }
}
