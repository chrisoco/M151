<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    protected $fillable = ['categories_id', 'started_at', 'created_at', 'updated_at', 'player_name', 'points', 'points_s'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'categories_id');
    }

    public function getDurationAttribute()
    {
        $created = Carbon::parse($this->created_at);
        $started = Carbon::parse($this->started_at);

        return $created->diffInSeconds($started);
    }

    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('H:i, d/m/y');
    }

}
