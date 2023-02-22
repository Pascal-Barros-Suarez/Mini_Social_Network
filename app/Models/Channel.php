<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function communitylinks() // unit tablas usuarios y community link 1-N
    {
        return $this->hasMany(CommunityLink::class, 'channel_id');
        //return $this->hasMany(CommunityLink::class);

    }



}
