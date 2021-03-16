<?php

namespace Database\Seeders;

use App\Models\Highscore;
use Illuminate\Database\Seeder;

class HighscoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Highscore::factory()->count(15)->create();
    }
}
