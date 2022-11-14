<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'name',
        'description',
        'priceValidUntil',
    ];

    protected $casts = [
        'priceValidUntil' => 'datetime',
    ];

    public function camp(): BelongsTo {
        return $this->belongsTo(Camp::class);
    }
}
