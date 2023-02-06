<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $fillable = [
        'id', 'title', 'slug', 'color'
    ];

    public function definition()
    {
        return [
            'id' => \App\Models\Channel::all()->random()->id,
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'color' => $this->faker->rgbCssColor
        ];
    }
}
