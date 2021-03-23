<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(8)->has(
            Question::factory()->count(3)->has(
                Answer::factory()->count(4)
            )
        )->create();

        foreach($categories as $c) {
            foreach($c->questions as $q) {
                $q->correct_answer = $q->answers->random()->id;
                $q->save();
            }
        }
    }
}
