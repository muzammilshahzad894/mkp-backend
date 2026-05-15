<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $blog = $this->route('blog');

        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($blog->id),
            ],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'body' => ['required', 'string'],
            'featured_image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'published_date' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $slug = $this->input('slug');
        $publishedDate = $this->input('published_date');
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'slug' => is_string($slug) && $slug === '' ? null : $slug,
            'published_date' => is_string($publishedDate) && $publishedDate === '' ? null : $publishedDate,
            'category' => $this->normalizedOptionalString('category'),
            'meta_title' => $this->normalizedOptionalString('meta_title'),
            'meta_description' => $this->normalizedOptionalString('meta_description'),
            'meta_keywords' => $this->normalizedOptionalString('meta_keywords'),
        ]);
    }

    private function normalizedOptionalString(string $key): ?string
    {
        $value = $this->input($key);
        if (! is_string($value)) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }
}
