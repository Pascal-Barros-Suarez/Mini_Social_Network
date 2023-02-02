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


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'channel_id' => 1,
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'approved' => 0
           ];
    }
}
