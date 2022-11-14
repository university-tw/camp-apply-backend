<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Camp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function offers(): HasMany {
        return $this->hasMany(Offer::class);
    }
}
