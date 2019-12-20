<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class CompanyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(! auth()->check()) {
            Log::alert('Company Scope: Table name '.$model->getTable());
        }
//
        if(auth()->check()) {
            $builder->whereHas('company', function ($q) use ($model) {
                $q->where($model->getTable() . '.company_id', auth()->user()->company_id);
            });
        }
    }

}
