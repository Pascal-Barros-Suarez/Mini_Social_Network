<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'channel_id', 'title', 'link', 'approved'
    ];


    public function creator() // unir tablas usuarios y community link 1-N
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hasAlreadyBeenSubmitted($link)
    {
        if ($existing = static::where('link', $link)->first()) {
            $existing->touch();
            $existing->save();
            return true;
        }
        return false;
    }

    public function channel() // unir tablas usuarios y community link 1-N
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
    }
}

//