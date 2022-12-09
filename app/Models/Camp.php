<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Camp extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $with = [
        'offers',
        'bank_accounts'
    ];

    public function offers(): HasMany {
        return $this->hasMany(Offer::class);
    }

    public function times(): HasMany {
        return $this->hasMany(CampTime::class);
    }

    public function applies(): HasManyThrough {
        return $this->hasManyThrough(Apply::class, CampTime::class,);
    }

    public function bank_accounts() : BelongsToMany {
        return $this->belongsToMany(BankAccount::class);
    }
}
