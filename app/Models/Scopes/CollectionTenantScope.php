<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CollectionTenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (!Auth::check()) {
            return;
        }

        $authenticatedUser = Auth::user();

        if ($authenticatedUser === null) {
            return;
        }

        if ($authenticatedUser->hasRole('super-admin')) {
            return;
        }

        $builder->whereHas('project', function (Builder $projectBuilder) use ($authenticatedUser): void {
            $projectBuilder->where('user_id', '=', $authenticatedUser->getKey());
        });
    }
}
