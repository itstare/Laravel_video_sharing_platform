<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Video;
use App\Models\Subscription;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function video(){
        return $this->hasMany(Video::class);
    }

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }

    public function subscribers(){
        return $this->subscription->count();
    }
}
