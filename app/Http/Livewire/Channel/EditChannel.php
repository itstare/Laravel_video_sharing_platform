<?php

namespace App\Http\Livewire\Channel;

use Livewire\Component;
use App\Models\Channel;
use Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Image;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $channel;
    public $image;

    protected function rules() { 
        return [
            'channel.name' => 'required|min:3|max:65|unique:channels,name,' . $this->channel->id,
            'channel.description' => 'nullable|max:1200',
            'image' => 'nullable|image|max:3200',
        ];
    }

    public function mount(Channel $channel){
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.channel.edit-channel')->extends('layouts.app');
    }

    public function update(){
        $this->authorize('update', $this->channel);
        $this->validate();
        $this->channel->update([
            'name' => $this->channel->name,
            'slug' => str_slug($this->channel->name, '-'),
            'description' => $this->channel->description,
        ]);

        //check if there is an image
        if($this->image){
            //save image
            $image = $this->image->storeAs('images', $this->channel->id . '.png');

            //resize and convert to png
            $img = Image::make(storage_path() . '/app' . $image)->encode('png')->fit(80, 80, function ($constraint) {
                    $constraint->upsize();
                })->save();

            //save path to db
            $this->channel->update([
                'image' => $this->channel->id . '.png',
            ]);
        }

        Session::flash('channel_update', 'Channel updated!');
        return redirect(route('channel.edit', $this->channel));
    }
}
