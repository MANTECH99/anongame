<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devinette extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'question',
        'answer',
        'category',
        'slug',
        'hint',
        'is_public',
        'challenges',
        'successes',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSuccessRateAttribute(): float
    {
        if ($this->challenges === 0) {
            return 0;
        }

        return round(($this->successes / $this->challenges) * 100, 1);
    }
}
