<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apply extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'token',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function camp_time(): BelongsTo {
        return $this->belongsTo(CampTime::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
