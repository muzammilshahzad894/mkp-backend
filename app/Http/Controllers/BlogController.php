<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->where('user_id', auth()->id())
            ->latest('updated_at')
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('blog.create');
    }

    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['featured_image']);

        $slug = filled($request->input('slug'))
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('title'));
        $data['slug'] = $this->uniqueSlug($slug);
        $data['user_id'] = auth()->id();
        $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        $data['published_date'] = $this->resolvedPublishedDate($data);

        Blog::query()->create($data);

        return redirect()->route('blogs.index')->with('status', 'blog-created');
    }

    public function edit(Blog $blog): View
    {
        $this->ensureOwner($blog);

        return view('blog.edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $this->ensureOwner($blog);

        $data = $request->validated();
        unset($data['featured_image']);

        $slug = filled($request->input('slug'))
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('title'));
        $data['slug'] = $this->uniqueSlug($slug, $blog->id);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $data['published_date'] = $this->resolvedPublishedDate($data, $blog);

        $blog->update($data);

        return redirect()->route('blogs.index')->with('status', 'blog-updated');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $this->ensureOwner($blog);

        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('status', 'blog-deleted');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolvedPublishedDate(array $data, ?Blog $existing = null): ?string
    {
        $raw = $data['published_date'] ?? null;
        $hasDate = is_string($raw) && $raw !== '';

        if (! empty($data['is_published'])) {
            if ($hasDate) {
                return $raw;
            }

            return $existing?->published_date?->format('Y-m-d') ?? now()->toDateString();
        }

        if ($hasDate) {
            return $raw;
        }

        return $existing?->published_date?->format('Y-m-d');
    }

    private function ensureOwner(Blog $blog): void
    {
        abort_unless($blog->user_id === auth()->id(), 403);
    }

    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base;
        $suffix = 1;

        while (
            Blog::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
