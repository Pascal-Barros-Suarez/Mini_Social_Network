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


    public function creator() // unit tablas usuarios y community link 1-N
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel() // unit tablas usuarios y community link 1-N
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    protected static function hasAlreadyBeenSubmitted($link)
    {
        if ($existing = static::where('link', $link)->first()) {
            $existing->touch();
            $existing->save();
            return true;
        }
        return false;
    }


    /* public function definition()
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'channel_id' => 1,
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'approved' => 0
           ];
    } */
}
