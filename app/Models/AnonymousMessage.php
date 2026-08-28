<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnonymousMessage extends Model
{
    protected $fillable = [
        'anonymous_link_id',
        'content',
        'is_read',
        'sender_name',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function anonymousLink(): BelongsTo
    {
        return $this->belongsTo(AnonymousLink::class);
    }
}
