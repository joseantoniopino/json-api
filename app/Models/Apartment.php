<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeName(Builder $query, $value)
    {
        $query->where('name', 'LIKE', "%$value%");
    }

    public function scopeDescription(Builder $query, $value)
    {
        $query->where('description', 'LIKE', "%$value%");
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at',$value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at',$value);
    }
}
