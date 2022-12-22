<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'name',
        'description',
        'priceValidUntil',
        'limit',
        'unlock_code'
    ];

    protected $appends = [
        'locked'
    ];

    protected $hidden = [
        'unlock_code'
    ];

    protected $casts = [
        'priceValidUntil' => 'datetime',
    ];

    public function getLockedAttribute(): bool
    {
        return $this->unlock_code !== null;
    }

    public function camp(): BelongsTo
    {
        return $this->belongsTo(Camp::class);
    }

    public function applies(): HasMany
    {
        return $this->hasMany(Apply::class);
    }
}
