<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    public array $allowedSorts = ['title', 'description'];

    protected $fillable = ['id', 'title', 'description'];


    protected $casts = [
        'id' => 'string',
    ];

    public function fields(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'created-at' => $this->created_at,
            'updated-at' => $this->updated_at,
        ];
    }

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function getApartments()
    {
        $data = [];
        dd($this->apartments);
        foreach ($this->apartments as $apartment){
            $data['ids'][] = $apartment->id;
        }
        return $data;
    }


    public function scopeTitle(Builder $query, $value)
    {
        $query->orWhere('title', 'LIKE', "%$value%");
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
            $query->orWhere('title', 'LIKE', "%$value%")
                ->orWhere('description','LIKE', "%$value%");
        }
    }
}
