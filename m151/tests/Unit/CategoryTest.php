<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function test_cat_validation_not_valid()
    {

        $cat = Category::factory()->make();

        $this->assertTrue($cat->not_valid);

    }

    public function test_cat_validation_valid()
    {

        $cat = Category::factory()->has(
            Question::factory()->count(4)->has(
                Answer::factory()->count(4)
            )
        )->make();

        foreach($cat->questions as $q) {

            $q->fill([
                'correct_answer' => $q->answers->random()->id
            ]);

        }

        $this->assertFalse($cat->not_valid);

    }
}
