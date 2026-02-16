<?php

namespace App\Models;

use App\Models\Scopes\CollectionTenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $public_id
 * @property int $project_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property array<array-key, mixed> $schema
 * @property bool $is_media_collection
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Project $project
 * @method static \Database\Factories\CollectionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereIsMediaCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereSchema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
