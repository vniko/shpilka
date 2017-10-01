<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait Filterable
{
    public function scopeFilter(Builder $query, $filters = [])
    {
        if (is_string($filters)) {
            $filters = json_decode($filters, true);
        }

        $table = $query->getModel()->getTable();
        foreach ($filters as $field => $filter) {
            if (method_exists($query->getModel(), 'scopeFilterBy' . studly_case($field)) || !Schema::hasColumn($table, $field)) {
                $method = 'filterBy' . studly_case($field);
                $query->$method($filter);
            } else {
                $query->where($table . '.' . $field, $filter);
            }
        }
        return $query;
    }

}
