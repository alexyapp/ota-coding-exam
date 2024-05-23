<?php

namespace App\Models;

use App\Contracts\MorphManyDescriptionsInterface;
use App\Contracts\MorphOneCategoryInterface;
use App\Contracts\MorphToManyTagsInterface;
use App\Traits\MorphManyDescriptionsTrait;
use App\Traits\MorphOneCategoryTrait;
use App\Traits\MorphToManyTagsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class JobAd extends Model implements MorphManyDescriptionsInterface, MorphOneCategoryInterface, MorphToManyTagsInterface
{
    use HasFactory, HasSlug, MorphManyDescriptionsTrait, MorphOneCategoryTrait, MorphToManyTagsTrait, SoftDeletes, Searchable;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at')
            ->whereNull('marked_as_spam_at');
    }

    public function scopeSpam(Builder $query): void
    {
        $query->whereNotNull('marked_as_spam_at')
            ->whereNull('published_at');
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class);
    }

    public function isPublished(): bool
    {
        return !is_null($this->published_at);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Applies Scout Extended default transformations:
        $array = $this->transform($array);

        $array['tags'] = $this->tags->toArray();
        $array['descriptions'] = $this->descriptions->pluck('body')->toArray();

        return $array;
    }
}
