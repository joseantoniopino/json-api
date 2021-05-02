<?php


namespace Src\JsonApi;


use Illuminate\Support\Str;

class JsonApiBuilder
{
    public function jsonPaginate(): \Closure
    {
        return function () {
            return
                $this->paginate(
                    perPage:request('page.size'),
                    pageName:'page[number]',
                    page:request('page.number')
                )->appends(request()->except('page.number'));
        };
    }

    public function applySorts(): \Closure
    {
        return function () {
            if (!property_exists($this->model, 'allowedSorts'))
                abort(500, 'Please set the public property $allowedSorts inside ' . get_class($this->model));

            if (is_null($sorts = request('sort')))
                return $this;

            $sortFields = Str::of($sorts)->explode(',');

            foreach ($sortFields as $sortField){
                $direction = 'asc';
                if (Str::of($sortField)->startsWith('-')){
                    $direction = 'desc';
                    $sortField = Str::of($sortField)->substr(1);
                }

                if (!collect($this->model->allowedSorts)->contains($sortField))
                    abort(400, "Invalid Query Parameter, '$sortField'");

                $this->orderBy($sortField, $direction);
            }
            return $this;
        };
    }

    public function applyFilters(): \Closure
    {
        return function () {
            foreach (request('filter', []) as $filter => $value){
                if (!$this->hasNamedScope($filter))
                    abort(400, "$filter is not allowed");
                $this->{$filter}($value);
            }
            return $this;
        };
    }

    /*public function withRelations(): \Closure
    {
        return function (){
            if (is_null($includes = request('include')))
                return $this;

            Str::of($includes)->explode(',');
            foreach ($includes as $value){
                if (!collect($this->model->allowedRelations)->contains($value))
                    abort(400, "Relation not allowed, '$value'");
                $this->model->chargeRelations($value);

            }
            return $this;
        };

    }*/
}
