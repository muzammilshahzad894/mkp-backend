@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Blog') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'blog-created')
                <p class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ __('Post created.') }}</p>
            @elseif (session('status') === 'blog-updated')
                <p class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ __('Post updated.') }}</p>
            @elseif (session('status') === 'blog-deleted')
                <p class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ __('Post deleted.') }}</p>
            @endif

            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <p class="text-sm text-gray-600">{{ __('Manage your blog posts.') }}</p>
                <a
                    href="{{ route('blogs.create') }}"
                    class="inline-flex items-center rounded-xl border border-transparent bg-gradient-to-r from-violet-600 to-violet-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-lg shadow-violet-500/25 transition hover:from-violet-500 hover:to-violet-600"
                >
                    {{ __('New post') }}
                </a>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <ul class="divide-y divide-slate-100">
                    @forelse ($blogs as $blog)
                        <li class="flex flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                            @if ($blog->featured_image)
                                <div class="shrink-0 sm:mr-4">
                                    <img
                                        src="{{ $blog->featured_image_url }}"
                                        alt=""
                                        class="h-20 w-28 rounded-lg border border-slate-200 object-cover"
                                    >
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                @if ($blog->category)
                                    <p class="truncate text-xs font-medium uppercase tracking-wide text-violet-600">{{ $blog->category }}</p>
                                @endif
                                <p class="truncate font-semibold text-slate-900">{{ $blog->title }}</p>
                                <p class="mt-0.5 truncate text-xs text-slate-500">{{ $blog->slug }}</p>
                                <p class="mt-1 text-xs text-slate-500">
                                    @if ($blog->is_published)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 font-medium text-emerald-800 ring-1 ring-emerald-600/15">{{ __('Published') }}</span>
                                        @if ($blog->published_date)
                                            <span class="ml-2">{{ $blog->published_date->translatedFormat('j M Y') }}</span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 font-medium text-slate-700 ring-1 ring-slate-600/10">{{ __('Draft') }}</span>
                                        @if ($blog->published_date)
                                            <span class="ml-2 text-slate-500">{{ $blog->published_date->translatedFormat('j M Y') }}</span>
                                        @endif
                                    @endif
                                </p>
                            </div>
                            <div class="flex shrink-0 items-center gap-2">
                                <a
                                    href="{{ route('blogs.edit', $blog) }}"
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" onsubmit="return confirm(@json(__('Delete this post?')));">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-200 bg-white px-3 py-1.5 text-sm font-medium text-red-700 shadow-sm hover:bg-red-50"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-12 text-center text-sm text-slate-500 sm:px-6">
                            {{ __('No posts yet.') }}
                            <a href="{{ route('blogs.create') }}" class="font-medium text-violet-600 hover:text-violet-500">{{ __('Create your first post') }}</a>
                        </li>
                    @endforelse
                </ul>
            </div>

            @if ($blogs->hasPages())
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
