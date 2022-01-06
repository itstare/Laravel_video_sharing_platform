<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Video;
use App\Models\Reply;

class Comment extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function video(){
        return $this->belongsTo(Video::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
