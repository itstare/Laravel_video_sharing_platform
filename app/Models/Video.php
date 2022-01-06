<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;
use Carbon\Carbon;
use App\Models\Like;
use App\Models\Dislike;
use App\Models\Comment;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function getThumbnailAttribute(){
        if($this->thumbnail_img){
        return '/videos/' . $this->id . '/' . $this->thumbnail_img;
        } else{
            return '/videos/' . 'default.png';
        }
    }

    public function getUploadDateAttribute(){
        $date = new Carbon($this->created_at);
        return $date->toFormattedDateString();
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }

    public function dislike(){
        return $this->hasMany(Dislike::class);
    }

    public function doesUserLikeVideo(){
        return $this->like()->where('user_id', auth()->user()->id)->exists();
    }

    public function doesUserDislikeVideo(){
        return $this->dislike()->where('user_id', auth()->user()->id)->exists();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
