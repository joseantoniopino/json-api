<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
    ];


    public function level(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
