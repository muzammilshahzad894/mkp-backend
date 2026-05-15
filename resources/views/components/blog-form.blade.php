@props([
    'action',
    'method' => 'POST',
    'submitLabel' => __('Save'),
    'blog' => null,
])

@php
    $methodUpper = strtoupper($method);
    $dateVal = old('published_date', $blog?->published_date?->format('Y-m-d'));

    $lbl  = 'block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5';
    $inp = 'block w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 transition placeholder:text-slate-100 focus:border-violet-500 focus:outline-none focus:ring-0 focus:shadow-none mt-1';
    $txt  = $inp . ' resize-y';
    $mono = $inp . ' resize-y font-mono text-[12.5px] leading-relaxed';
@endphp

<style>
    .form-section {
        background: #fff;
        border: 1px solid #e8eaf0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 4px 0 rgba(30,35,80,0.05);
    }
    .form-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 20px;
        background: #f8f9fc;
        border-bottom: 1px solid #e8eaf0;
    }
    .form-section-header .section-icon {
        width: 28px; height: 28px;
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
    }
    .form-section-header h3 {
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: #3d4466;
        margin: 0;
    }
    .form-section-header p {
        font-size: 11.5px;
        color: #8890b0;
        margin: 0;
        margin-left: auto;
    }
    .form-section-body {
        padding: 20px;
    }
    .field-hint {
        font-size: 11px;
        color: #9ba3bf;
        margin-top: 3px;
        margin-bottom: 0;
        line-height: 1.5;
    }
    .field-error {
        font-size: 11.5px;
        color: #dc2626;
        margin-top: 5px;
    }
    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 768px) {
        .grid-2, .grid-3 { grid-template-columns: 1fr; }
        .form-section-header p { display: none; }
    }
    .divider {
        border: none;
        border-top: 1px solid #eef0f6;
        margin: 18px 0;
    }
    /* Publish toggle */
    .publish-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: #f6f8ff;
        border: 1px solid #dde2f5;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.15s;
    }
    .publish-toggle:hover { background: #eef1fd; }
    .publish-toggle input[type="checkbox"] {
        width: 16px; height: 16px;
        accent-color: #4f46e5;
        cursor: pointer;
        flex-shrink: 0;
    }
    .publish-toggle .toggle-text strong {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #2d3260;
    }
    .publish-toggle .toggle-text span {
        font-size: 11.5px;
        color: #8890b0;
    }
    /* Submit bar */
    .submit-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 20px;
        background: #f8f9fc;
        border: 1px solid #e8eaf0;
        border-radius: 14px;
        box-shadow: 0 1px 4px 0 rgba(30,35,80,0.05);
    }
    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px;
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #fff;
        font-size: 13px; font-weight: 600;
        border: none; border-radius: 9px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(79,70,229,0.28);
        transition: opacity 0.15s, box-shadow 0.15s;
        text-decoration: none;
    }
    .btn-primary:hover { opacity: 0.92; box-shadow: 0 4px 14px rgba(79,70,229,0.32); }
    .btn-secondary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 16px;
        background: #fff;
        color: #4b5280;
        font-size: 13px; font-weight: 500;
        border: 1px solid #dde2f5; border-radius: 9px;
        cursor: pointer;
        transition: background 0.15s;
        text-decoration: none;
    }
    .btn-secondary:hover { background: #f6f8ff; }
    /* Image preview */
    .img-preview {
        margin-top: 12px;
        border-radius: 10px;
        border: 1px solid #e8eaf0;
        overflow: hidden;
        background: #f8f9fc;
    }
    .img-preview p {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9ba3bf;
        padding: 8px 12px 0;
    }
    .img-preview img {
        display: block;
        width: 100%;
        max-height: 180px;
        object-fit: cover;
    }

    input::placeholder,
    textarea::placeholder {
        color: #94a3b8 !important;
        opacity: 1;
    }
</style>

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if ($methodUpper !== 'POST')
        @method($methodUpper)
    @endif

    {{-- ── POST DETAILS ── --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="section-icon" style="background:#eef0fd; color:#4f46e5;">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h3>Post</h3>
            <p>Title, slug, category &amp; date</p>
        </div>
        <div class="form-section-body space-y-4">

            {{-- Title + Slug --}}
            <div class="grid-2">
                <div>
                    <label for="title" class="{{ $lbl }}">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $blog?->title) }}" required autofocus class="{{ $inp }}">
                    @error('title')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="slug" class="{{ $lbl }}">URL Slug</label>
                    <input id="slug" name="slug" type="text" value="{{ old('slug', $blog?->slug) }}" placeholder="Leave blank to auto-generate from title." spellcheck="false" class="{{ $inp }} font-mono text-[12.5px]">
                    @error('slug')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- <hr class="divider"> --}}

            {{-- Category + Date --}}
            <div class="grid-2">
                <div>
                    <label for="category" class="{{ $lbl }}">Category</label>
                    <input id="category" name="category" type="text" value="{{ old('category', $blog?->category) }}" class="{{ $inp }}">
                    @error('category')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="published_date" class="{{ $lbl }}">Published Date</label>
                    <input id="published_date" name="published_date" type="date" value="{{ $dateVal }}" class="{{ $inp }}">
                    @error('published_date')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- <hr class="divider"> --}}

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="{{ $lbl }}">Excerpt</label>
                <p class="field-hint">Short summary shown in listings and cards.</p>
                <textarea id="excerpt" name="excerpt" rows="2" placeholder="Brief summary…" class="{{ $txt }}">{{ old('excerpt', $blog?->excerpt) }}</textarea>
                @error('excerpt')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            {{-- <hr class="divider"> --}}

            {{-- Body --}}
            <div>
                <label for="body" class="{{ $lbl }}">Content</label>
                <p class="field-hint">Full article body (HTML or plain text).</p>
                <textarea id="body" name="body" rows="12" required placeholder="Write your article…" class="{{ $mono }}">{{ old('body', $blog?->body) }}</textarea>
                @error('body')<p class="field-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

    {{-- ── SEO ── --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="section-icon" style="background:#f0fdf4; color:#16a34a;">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
            </div>
            <h3>SEO</h3>
            <p>Meta tags for search engines &amp; social previews</p>
        </div>
        <div class="form-section-body space-y-4">

            {{-- Meta title + Keywords in one row --}}
            <div class="grid-2">
                <div>
                    <label for="meta_title" class="{{ $lbl }}">Meta Title</label>
                    <p class="field-hint">Recommended 50–60 characters.</p>
                    <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title', $blog?->meta_title) }}" maxlength="70" placeholder="SEO page title…" class="{{ $inp }}">
                    @error('meta_title')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="meta_keywords" class="{{ $lbl }}">Meta Keywords</label>
                    <p class="field-hint">Optional, comma-separated.</p>
                    <input id="meta_keywords" name="meta_keywords" type="text" value="{{ old('meta_keywords', $blog?->meta_keywords) }}" placeholder="keyword one, keyword two…" class="{{ $inp }}">
                    @error('meta_keywords')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="meta_description" class="{{ $lbl }}">Meta Description</label>
                <p class="field-hint">Recommended 150–160 characters.</p>
                <textarea id="meta_description" name="meta_description" rows="2" maxlength="320" placeholder="Brief description for search results…" class="{{ $txt }}">{{ old('meta_description', $blog?->meta_description) }}</textarea>
                @error('meta_description')<p class="field-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

    {{-- ── IMAGE & VISIBILITY ── --}}
    <div class="form-section">
        <div class="form-section-header">
            <div class="section-icon" style="background:#fff7ed; color:#ea580c;">
                <i class="fa-solid fa-image"></i>
            </div>
            <h3>Image &amp; Visibility</h3>
            <p>Cover photo and publish status</p>
        </div>
        <div class="form-section-body">
            <div class="grid-2" style="align-items: start;">

                {{-- Featured image --}}
                <div>
                    <label for="featured_image" class="{{ $lbl }}">Featured Image</label>
                    <p class="field-hint">JPEG, PNG, or WebP · max 5 MB.@if ($blog?->featured_image) Upload a new file to replace.@endif</p>
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
                    @error('featured_image')<p class="field-error">{{ $message }}</p>@enderror
                    @if ($blog?->featured_image)
                        <div class="img-preview">
                            <p>Current image</p>
                            <img src="{{ $blog->featured_image_url }}" alt="">
                        </div>
                    @endif
                </div>

                {{-- Publish toggle --}}
                <div>
                    <label class="{{ $lbl }}">Visibility</label>
                    <p class="field-hint">Control whether this post is publicly live.</p>
                    <input type="hidden" name="is_published" value="0">
                    <label class="publish-toggle mt-2">
                        <input
                            id="is_published"
                            name="is_published"
                            type="checkbox"
                            value="1"
                            @checked(old('is_published', $blog?->is_published ?? false))
                        >
                        <div class="toggle-text">
                            <strong>Published</strong>
                            <span>Post is live and visible on the site.</span>
                        </div>
                    </label>
                    @error('is_published')<p class="field-error">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>
    </div>

    {{-- ── SUBMIT BAR ── --}}
    <div class="submit-bar">
        <div style="display:flex; gap:10px; align-items:center;">
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ $submitLabel }}
            </button>
            <a href="{{ route('blogs.index') }}" class="btn-secondary">
                <i class="fa-solid fa-xmark"></i>
                {{ __('Cancel') }}
            </a>
        </div>
        <span style="font-size:11.5px; color:#9ba3bf;">
            <i class="fa-solid fa-circle-info mr-1"></i>
            All fields marked as required must be filled.
        </span>
    </div>

</form>