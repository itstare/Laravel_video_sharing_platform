<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Channel\EditChannel;
use App\Http\Livewire\Video\CreateVideo;
use App\Http\Livewire\Video\EditVideo;
use App\Http\Livewire\Video\ShowVideo;
use App\Http\Livewire\Video\AllVideo;
use App\Http\Livewire\Video\WatchVideo;
use App\Models\Channel;
use App\Models\Video;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChannelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        $channels = Auth::user()->subscribedChannels()->with('video')->get();
        return view('welcome', compact('channels'));
    } else{
        $videos = Video::all();
        return view('welcome', compact('videos'));
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/channel/{channel}/edit', EditChannel::class)->middleware('auth')->name('channel.edit');
Route::get('/channel/{slug}', [ChannelController::class, 'index'])->middleware('auth')->name('channel.index');

Route::get('/videos/{channel}/create', CreateVideo::class)->middleware('auth')->name('video.create');
Route::get('/videos/{channel}/{video}/edit', EditVideo::class)->middleware('auth')->name('video.edit');
Route::get('/channel/videos', AllVideo::class)->middleware('auth')->name('video.all');
Route::get('video/{video}', WatchVideo::class)->name('video.watch');

Route::get('/search', [SearchController::class, 'search'])->name('search');

