<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Categorie;
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
        $categories = Categorie::factory()->count(8)->has(
            Question::factory()->count(10)->has(
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
