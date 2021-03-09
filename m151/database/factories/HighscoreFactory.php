<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Highscore;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HighscoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Highscore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'player_name'   => $this->faker->name,
            'started_at'    => Carbon::now()->subMinutes(10)->format('Y-m-d H:i:s'),
            'points'        => $this->faker->numberBetween(30, 300),
            'points_s'      => 0,
            'categories_id' => Category::all()->random()->id,

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Highscore $h) {
            $created = Carbon::parse($h->created_at);
            $started = Carbon::parse($h->started_at);
            $diff    = $created->diffInSeconds($started);

            $h->points_s   = round($h->points / $diff, 2);
            $h->started_at = $started;
            $h->save();

        });
    }

}
