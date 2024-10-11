<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'play_url',
        'artist'
    ];

    /**
     * Indicate the track's contributer.
     */
    public function contributer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contributer_id');
    }

    /**
     * Indicate the code's guest.
     */
    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class, 'week_id');
    }
}
