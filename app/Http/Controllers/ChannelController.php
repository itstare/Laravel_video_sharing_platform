<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index($slug){
        $channel = Channel::where('slug', $slug)->first();
        return view('channel.index', compact('channel'));
    }
}
