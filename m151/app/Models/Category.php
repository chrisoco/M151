<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property Question[] $questions
 * @property Highscore[] $highscores
 */
class Category extends Model
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
    protected $fillable = ['created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'categories_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function highscores()
    {
        return $this->hasMany('App\Models\Highscore', 'categories_id');
    }

    // TODO: Check if Cat Valid and Q->A
    public function getNotValidAttribute()
    {
        if(count($this->questions) < 3) return true;

        foreach($this->questions as $q) {

            if(count($q->answers) != 4 || is_null($q->c_answer)) return true;

        }

        return false;

    }
}
