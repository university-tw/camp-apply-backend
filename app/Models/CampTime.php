<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampTime extends Model {
    use HasFactory;

    protected $fillable = [
        'start',
        'end'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date'
    ];

    public function camp() {
        return $this->belongsTo(Camp::class);
    }
}
