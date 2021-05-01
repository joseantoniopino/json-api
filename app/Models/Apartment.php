<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    use HasFactory;

    public array $allowedSorts = ['name', 'description', 'quantity'];

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = ['id', 'category_id', 'name', 'description', 'quantity'];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
