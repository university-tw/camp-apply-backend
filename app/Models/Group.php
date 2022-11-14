<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    use HasFactory, HasUlids;

    protected $fillable = [
        'name'
    ];

    public function camp() {
        return $this->belongsTo(Camp::class);
    }
}
