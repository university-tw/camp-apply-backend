<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account',
        'code'
    ];

    public function camps(): BelongsToMany
    {
        return $this->belongsToMany(Camp::class);
    }
}
