<?php


namespace Src\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasSorts
{
    public function scopeApplySorts(Builder $query, $sorts)
    {
        if (!property_exists($this, 'allowedSorts'))
            abort(500, 'Please set the public property $allowedSorts inside ' . get_class($this));

        if (is_null($sorts))
            return;

        $sortFields = Str::of($sorts)->explode(',');

        foreach ($sortFields as $sortField){
            $direction = 'asc';
            if (Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }

            if (!collect($this->allowedSorts)->contains($sortField))
                abort(400, "Invalid Query Parameter");

            $query->orderBy($sortField, $direction);
        }
    }
}
