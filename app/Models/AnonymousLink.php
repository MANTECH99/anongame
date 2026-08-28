<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnonymousLink extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'is_active',
        'message_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(AnonymousMessage::class)->latest();
    }

    public function unreadCount(): int
    {
        return $this->messages()->where('is_read', false)->count();
    }
}
