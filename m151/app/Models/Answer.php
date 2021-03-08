<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $value
 * @property Question[] $correct_question
 * @property Question[] $questions
 */
class Answer extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function correct_question()
    {
        return $this->hasMany('App\Models\Question', 'correct_answer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany('App\Models\Question', 'questions_answers', 'answers_id', 'questions_id');
    }
}
