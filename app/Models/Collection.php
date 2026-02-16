<?php

namespace App\Models;

use App\Models\Scopes\CollectionTenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\CollectionFactory> */
    use HasFactory;

    protected $fillable = [
        'public_id',
        'project_id',
        'name',
        'slug',
        'description',
        'schema',
        'is_media_collection',
    ];

    protected function casts(): array
    {
        return [
            'schema' => 'array',
            'is_media_collection' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new CollectionTenantScope());
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
