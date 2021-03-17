<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $correct_answer
 * @property string $created_at
 * @property string $updated_at
 * @property string $value
 * @property int $answered_correct
 * @property int $answered_false
 * @property Answer $c_answer
 * @property Category[] $categories
 * @property Answer[] $answers
 */
class Question extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['correct_answer', 'created_at', 'updated_at', 'value', 'answered_correct', 'answered_false'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function c_answer()
    {
        return $this->belongsTo('App\Models\Answer', 'correct_answer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_questions', 'questions_id', 'categories_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function answers()
    {
        return $this->belongsToMany('App\Models\Answer', 'questions_answers', 'questions_id', 'answers_id');
    }
}
