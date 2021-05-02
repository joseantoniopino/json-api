<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory, SoftDeletes;

    public array $allowedSorts = ['name', 'description', 'quantity'];

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = ['id', 'category_id', 'name', 'description', 'quantity'];

    public function fields(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'created-at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeName(Builder $query, $value)
    {
        $query->orWhere('name', 'LIKE', "%$value%");
    }

    public function scopeDescription(Builder $query, $value)
    {
        $query->orWhere('description', 'LIKE', "%$value%");
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->orWhereYear('created_at',$value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->orWhereMonth('created_at',$value);
    }

    public function scopeSearch(Builder $query, $values)
    {
        foreach (Str::of($values)->explode(' ') as $value){
            $query->orWhere('name', 'LIKE', "%$value%")
                ->orWhere('description','LIKE', "%$value%");
        }
    }
}
