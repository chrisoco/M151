<?php

namespace Tests\Unit;

use App\Models\Question;
use Tests\TestCase;

class QuestionTest extends TestCase
{

    public function test_answered_percentage()
    {
        $question = Question::factory()->make();

        $this->assertEquals(100, $question->correct_answered_percent + $question->false_answered_percent);
    }
}
