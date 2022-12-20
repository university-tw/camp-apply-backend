<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apply extends Model {
    use HasFactory, HasUlids;

    protected $fillable = [
        'token',
        'data',

        'bank_code',
        'bank_account',
        'bank_comment',
        'paid_at',
        'status'
    ];

    protected $casts = [
        'data' => 'array',
        'paid_at' => 'datetime'
    ];

    public function getIsPaidAttribute(): bool {
        return $this->paid_at !== null;
    }

    public function setIsPaidAttribute($status): void {
        if($status){
            $this->paid_at = now();
            $this->status = 'paid';
        } else {
            $this->paid_at = null;
            if($this->status === 'paid'){
                $this->status = 'pending';
            }
        }
    }

    public function camp_time(): BelongsTo {
        return $this->belongsTo(CampTime::class);
    }

    public function offer() {
        return $this->belongsTo(Offer::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
