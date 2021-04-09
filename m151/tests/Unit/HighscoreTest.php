<?php

namespace Tests\Unit;

use App\Models\Highscore;
use Tests\TestCase;

class HighscoreTest extends TestCase
{

    public function test_duration()
    {

        $highscore = Highscore::factory()->make();

        $this->assertEquals(600, $highscore->duration);

    }
}
