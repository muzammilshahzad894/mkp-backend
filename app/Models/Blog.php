<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'category',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'excerpt',
        'body',
        'featured_image',
        'is_published',
        'published_date',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_date' => 'date',
        ];
    }

    /**
     * Public URL for the stored featured image, or null.
     *
     * @return Attribute<string|null, never>
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->featured_image
            ? Storage::disk('public')->url($this->featured_image)
            : null);
    }
}
