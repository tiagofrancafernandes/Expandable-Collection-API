<?php

namespace App\Models;

use App\Models\Scopes\ProjectTenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'public_id',
        'user_id',
        'name',
        'slug',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ProjectTenantScope());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
