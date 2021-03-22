<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['question_id', 'created_at', 'updated_at', 'value'];

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
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
