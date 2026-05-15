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
            'category' => ['required', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($blog->id),
            ],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'excerpt' => ['required', 'string', 'max:2000'],
            'body' => ['required', 'string', $this->bodyNotEmptyRule()],
            'featured_image' => [
                Rule::requiredIf(fn () => ! $blog->featured_image),
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:5120',
            ],
            'published_date' => ['required', 'date'],
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
            'category' => $this->normalizedRequiredString('category'),
            'excerpt' => $this->normalizedRequiredString('excerpt'),
            'body' => is_string($this->input('body')) ? trim($this->input('body')) : $this->input('body'),
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

    private function normalizedRequiredString(string $key): ?string
    {
        $value = $this->input($key);
        if (! is_string($value)) {
            return $value;
        }

        return trim($value);
    }

    /**
     * @return \Closure(string, mixed, \Closure): void
     */
    private function bodyNotEmptyRule(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail): void {
            $plain = trim(html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

            if ($plain === '') {
                $fail(__('The content field is required.'));
            }
        };
    }
}
