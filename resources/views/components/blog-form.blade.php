@props([
    'action',
    'method' => 'POST',
    'submitLabel' => __('Save'),
    'blog' => null,
])

@php
    $methodUpper = strtoupper($method);
    $dateVal = old('published_date', $blog?->published_date?->format('Y-m-d'));

    $lbl = 'block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5';
    $inp = 'block w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-violet-500 focus:outline-none focus:ring-0 focus:shadow-none mt-1';
    $txt = $inp . ' resize-y';
    $mono = $inp . ' resize-y font-mono text-[12.5px] leading-relaxed';
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if ($methodUpper !== 'POST')
        @method($methodUpper)
    @endif

    {{-- ── POST DETAILS ── --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="flex items-center gap-2.5 px-5 py-3.5 bg-slate-50 border-b border-slate-200">
            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs bg-indigo-50 text-indigo-600 shrink-0">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h3 class="text-[11.5px] font-bold uppercase tracking-widest text-slate-600 m-0">Post</h3>
            <p class="text-[11.5px] text-slate-400 ml-auto hidden md:block">Title, slug, category &amp; date</p>
        </div>
        <div class="p-5 space-y-4">

            {{-- Title + Slug --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="{{ $lbl }}">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $blog?->title) }}" required autofocus class="{{ $inp }}">
                    @error('title')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="slug" class="{{ $lbl }}">URL Slug</label>
                    <input id="slug" name="slug" type="text" value="{{ old('slug', $blog?->slug) }}" placeholder="Leave blank to auto-generate from title." spellcheck="false" class="{{ $inp }} font-mono text-[12.5px]">
                    @error('slug')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Category + Date --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="category" class="{{ $lbl }}">Category</label>
                    <input id="category" name="category" type="text" value="{{ old('category', $blog?->category) }}" class="{{ $inp }}">
                    @error('category')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="published_date" class="{{ $lbl }}">Published Date</label>
                    <input id="published_date" name="published_date" type="date" value="{{ $dateVal }}" class="{{ $inp }}">
                    @error('published_date')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="{{ $lbl }}">Excerpt</label>
                <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Short summary shown in listings and cards.</p>
                <textarea id="excerpt" name="excerpt" rows="2" placeholder="Brief summary…" class="{{ $txt }}">{{ old('excerpt', $blog?->excerpt) }}</textarea>
                @error('excerpt')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Body --}}
            <div>
                <label for="body" class="{{ $lbl }}">Content</label>
                <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Full article body (HTML or plain text).</p>
                <textarea id="body" name="body" rows="12" required placeholder="Write your article…" class="{{ $mono }}">{{ old('body', $blog?->body) }}</textarea>
                @error('body')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

    {{-- ── SEO ── --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="flex items-center gap-2.5 px-5 py-3.5 bg-slate-50 border-b border-slate-200">
            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs bg-green-50 text-green-600 shrink-0">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
            </div>
            <h3 class="text-[11.5px] font-bold uppercase tracking-widest text-slate-600 m-0">SEO</h3>
            <p class="text-[11.5px] text-slate-400 ml-auto hidden md:block">Meta tags for search engines &amp; social previews</p>
        </div>
        <div class="p-5 space-y-4">

            {{-- Meta title + Keywords --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="meta_title" class="{{ $lbl }}">Meta Title</label>
                    <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Recommended 50–60 characters.</p>
                    <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title', $blog?->meta_title) }}" maxlength="70" placeholder="SEO page title…" class="{{ $inp }}">
                    @error('meta_title')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="meta_keywords" class="{{ $lbl }}">Meta Keywords</label>
                    <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Optional, comma-separated.</p>
                    <input id="meta_keywords" name="meta_keywords" type="text" value="{{ old('meta_keywords', $blog?->meta_keywords) }}" placeholder="keyword one, keyword two…" class="{{ $inp }}">
                    @error('meta_keywords')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="meta_description" class="{{ $lbl }}">Meta Description</label>
                <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Recommended 150–160 characters.</p>
                <textarea id="meta_description" name="meta_description" rows="2" maxlength="320" placeholder="Brief description for search results…" class="{{ $txt }}">{{ old('meta_description', $blog?->meta_description) }}</textarea>
                @error('meta_description')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

    {{-- ── IMAGE & VISIBILITY ── --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="flex items-center gap-2.5 px-5 py-3.5 bg-slate-50 border-b border-slate-200">
            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs bg-orange-50 text-orange-600 shrink-0">
                <i class="fa-solid fa-image"></i>
            </div>
            <h3 class="text-[11.5px] font-bold uppercase tracking-widest text-slate-600 m-0">Image &amp; Visibility</h3>
            <p class="text-[11.5px] text-slate-400 ml-auto hidden md:block">Cover photo and publish status</p>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                {{-- Featured image --}}
                <div>
                    <label for="featured_image" class="{{ $lbl }}">Featured Image</label>
                    <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">
                        JPEG, PNG, or WebP · max 5 MB.@if ($blog?->featured_image) Upload a new file to replace.@endif
                    </p>
                    <input
                        id="featured_image"
                        name="featured_image"
                        type="file"
                        accept="image/jpeg,image/png,image/webp,.jpg,.jpeg,.png,.webp"
                        @if (! $blog) required @endif
                        class="mt-2 block w-full cursor-pointer text-sm text-slate-500
                               file:mr-3 file:cursor-pointer file:rounded-lg file:border-0
                               file:bg-indigo-600 file:px-4 file:py-2 file:text-xs file:font-semibold
                               file:text-white file:transition hover:file:bg-indigo-700"
                    >
                    @error('featured_image')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                    @if ($blog?->featured_image)
                        <div class="mt-3 rounded-xl border border-slate-200 overflow-hidden bg-slate-50">
                            <p class="text-[10.5px] font-bold uppercase tracking-widest text-slate-400 px-3 pt-2">Current image</p>
                            <img src="{{ $blog->featured_image_url }}" alt="" class="block w-full max-h-44 object-cover">
                        </div>
                    @endif
                </div>

                {{-- Publish toggle --}}
                <div>
                    <label class="{{ $lbl }}">Visibility</label>
                    <p class="text-[11px] text-slate-400 mt-0 mb-0 leading-relaxed">Control whether this post is publicly live.</p>
                    <input type="hidden" name="is_published" value="0">
                    <label class="flex items-center gap-3 mt-2 px-4 py-3.5 bg-indigo-50 border border-indigo-200 rounded-xl cursor-pointer transition hover:bg-indigo-100">
                        <input
                            id="is_published"
                            name="is_published"
                            type="checkbox"
                            value="1"
                            class="w-4 h-4 accent-indigo-600 cursor-pointer shrink-0"
                            @checked(old('is_published', $blog?->is_published ?? false))
                        >
                        <div>
                            <strong class="block text-[13px] font-semibold text-slate-700">Published</strong>
                            <span class="text-[11.5px] text-slate-400">Post is live and visible on the site.</span>
                        </div>
                    </label>
                    @error('is_published')<p class="text-[11.5px] text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>
    </div>

    {{-- ── SUBMIT BAR ── --}}
    <div class="flex items-center justify-between gap-3 px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl shadow-sm">
        <div class="flex items-center gap-2.5">
            <button type="submit"
                class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-gradient-to-br from-indigo-600 to-indigo-400 text-white text-[13px] font-semibold rounded-xl border-none cursor-pointer shadow-[0_2px_8px_rgba(79,70,229,0.28)] transition hover:opacity-90 hover:shadow-[0_4px_14px_rgba(79,70,229,0.32)] no-underline">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $submitLabel }}
            </button>
            <a href="{{ route('blogs.index') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-white text-slate-500 text-[13px] font-medium border border-indigo-200 rounded-xl cursor-pointer transition hover:bg-indigo-50 no-underline">
                <i class="fa-solid fa-xmark"></i>
                {{ __('Cancel') }}
            </a>
        </div>
        <span class="text-[11.5px] text-slate-400">
            <i class="fa-solid fa-circle-info mr-1"></i>
            All fields marked as required must be filled.
        </span>
    </div>

</form>