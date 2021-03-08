<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $categories_id
 * @property string $started_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $player_name
 * @property int $points
 * @property float $points_s
 * @property Category $category
 */
class Highscore extends Model
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
    protected $fillable = ['categories_id', 'started_at', 'created_at', 'updated_at', 'player_name', 'points', 'points_s'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id');
    }
}
