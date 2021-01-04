<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ScopeTask implements Scope
{
    public function apply(Builder $builder, Model $model) {
        $builder->where('user_id', Auth::user()->id);
        $builder->orderBy('sort', 'asc');
    }
}