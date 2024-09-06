<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ppsk extends Model {
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name'
    ];

    public function settings(): HasOne {
        return $this->hasOne(PpskSettings::class);
    }
}
