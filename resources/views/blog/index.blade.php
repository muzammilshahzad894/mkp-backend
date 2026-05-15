@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Blog') }}
    </h2>
@endsection

@section('content')
    <div class="py-6 px-4 sm:py-12 sm:px-6" x-data="{ alertDismissed: false }">
        <div class="max-w-7xl mx-auto">

            @if (session('status') === 'blog-created')
                <div
                    x-show="!alertDismissed"
                    x-transition.opacity.duration.200ms
                    class="login-alert-success mb-4 sm:mb-6"
                    role="status"
                >
                    <p>{{ __('Post created.') }}</p>
                    <button
                        type="button"
                        class="login-alert-dismiss"
                        @click="alertDismissed = true"
                        aria-label="{{ __('Dismiss notification') }}"
                    >
                        <i class="fa-solid fa-xmark h-4 w-4 shrink-0" aria-hidden="true"></i>
                    </button>
                </div>
            @elseif (session('status') === 'blog-updated')
                <div
                    x-show="!alertDismissed"
                    x-transition.opacity.duration.200ms
                    class="login-alert-success mb-4 sm:mb-6"
                    role="status"
                >
                    <p>{{ __('Post updated.') }}</p>
                    <button
                        type="button"
                        class="login-alert-dismiss"
                        @click="alertDismissed = true"
                        aria-label="{{ __('Dismiss notification') }}"
                    >
                        <i class="fa-solid fa-xmark h-4 w-4 shrink-0" aria-hidden="true"></i>
                    </button>
                </div>
            @elseif (session('status') === 'blog-deleted')
                <div
                    x-show="!alertDismissed"
                    x-transition.opacity.duration.200ms
                    class="login-alert-success mb-4 sm:mb-6"
                    role="status"
                >
                    <p>{{ __('Post deleted.') }}</p>
                    <button
                        type="button"
                        class="login-alert-dismiss"
                        @click="alertDismissed = true"
                        aria-label="{{ __('Dismiss notification') }}"
                    >
                        <i class="fa-solid fa-xmark h-4 w-4 shrink-0" aria-hidden="true"></i>
                    </button>
                </div>
            @endif

            <div class="mb-5 sm:mb-6 space-y-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-600">{{ __('Manage your blog posts.') }}</p>
                    <a
                        href="{{ route('blogs.create') }}"
                        class="inline-flex w-full sm:w-auto items-center justify-center rounded-xl border border-transparent bg-gradient-to-r from-violet-600 to-violet-500 px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-white shadow-lg shadow-violet-500/25 transition hover:from-violet-500 hover:to-violet-600"
                    >
                        <i class="fa-solid fa-plus mr-2" aria-hidden="true"></i>
                        {{ __('New post') }}
                    </a>
                </div>

                <form method="GET" action="{{ route('blogs.index') }}" class="flex flex-col gap-2 sm:flex-row sm:items-stretch">
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-sm" aria-hidden="true"></i>
                        </span>
                        <input
                            type="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="{{ __('Search by title, slug, category…') }}"
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 shadow-sm placeholder:text-slate-400 focus:border-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500/20"
                        >
                    </div>
                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="inline-flex flex-1 sm:flex-none items-center justify-center rounded-xl border border-violet-200 bg-violet-50 px-4 py-2.5 text-sm font-semibold text-violet-700 transition hover:bg-violet-100"
                        >
                            {{ __('Search') }}
                        </button>
                        @if ($search !== '')
                            <a
                                href="{{ route('blogs.index') }}"
                                class="inline-flex flex-1 sm:flex-none items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50"
                            >
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>

                @if ($search !== '')
                    <p class="text-xs text-slate-500">
                        {{ __('Showing results for') }}: <span class="font-semibold text-slate-700">"{{ $search }}"</span>
                    </p>
                @endif
            </div>

            <div class="space-y-3 sm:space-y-0 sm:overflow-hidden sm:bg-white sm:shadow sm:rounded-lg">
                <ul class="sm:divide-y sm:divide-slate-100">
                    @forelse ($blogs as $blog)
                        <li class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:rounded-none sm:border-0 sm:border-b sm:border-slate-100 sm:p-0 sm:shadow-none last:sm:border-b-0">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between sm:gap-4 sm:px-6 sm:py-4">
                                <div class="flex flex-col gap-3 min-[480px]:flex-row min-[480px]:items-start sm:flex-1 sm:min-w-0">
                                    @if ($blog->featured_image)
                                        <div class="shrink-0 w-full min-[480px]:w-auto">
                                            <img
                                                src="{{ $blog->featured_image_url }}"
                                                alt=""
                                                class="h-36 w-full rounded-lg border border-slate-200 object-cover min-[480px]:h-20 min-[480px]:w-28"
                                            >
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        @if ($blog->category)
                                            <p class="truncate text-xs font-medium uppercase tracking-wide text-violet-600">{{ $blog->category }}</p>
                                        @endif
                                        <p class="font-semibold text-slate-900 line-clamp-2 sm:truncate">{{ $blog->title }}</p>
                                        <p class="mt-0.5 truncate text-xs text-slate-500">{{ $blog->slug }}</p>
                                        <p class="mt-2 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                            @if ($blog->is_published)
                                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 font-medium text-emerald-800 ring-1 ring-emerald-600/15">{{ __('Published') }}</span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 font-medium text-slate-700 ring-1 ring-slate-600/10">{{ __('Draft') }}</span>
                                            @endif
                                            @if ($blog->published_date)
                                                <span>{{ $blog->published_date->translatedFormat('j M Y') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2 sm:flex sm:shrink-0 sm:items-center">
                                    <a
                                        href="{{ route('blogs.edit', $blog) }}"
                                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50 sm:py-1.5"
                                    >
                                        <i class="fa-solid fa-pen-to-square mr-1.5 sm:mr-0 sm:hidden" aria-hidden="true"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('blogs.destroy', $blog) }}"
                                        class="js-blog-delete-form"
                                        data-title="{{ $blog->title }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            class="js-blog-delete-btn inline-flex w-full items-center justify-center rounded-lg border border-red-200 bg-white px-3 py-2.5 text-sm font-medium text-red-700 shadow-sm transition hover:bg-red-50 sm:py-1.5"
                                        >
                                            <i class="fa-solid fa-trash mr-1.5 sm:mr-0 sm:hidden" aria-hidden="true"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="rounded-xl border border-dashed border-slate-200 bg-white px-4 py-12 text-center text-sm text-slate-500 sm:rounded-none sm:border-0 sm:bg-transparent sm:px-6">
                            @if ($search !== '')
                                {{ __('No posts match your search.') }}
                                <a href="{{ route('blogs.index') }}" class="mt-2 block font-medium text-violet-600 hover:text-violet-500">{{ __('Clear search') }}</a>
                            @else
                                {{ __('No posts yet.') }}
                                <a href="{{ route('blogs.create') }}" class="mt-2 block font-medium text-violet-600 hover:text-violet-500">{{ __('Create your first post') }}</a>
                            @endif
                        </li>
                    @endforelse
                </ul>
            </div>

            @if ($blogs->hasPages())
                <div class="mt-6 overflow-x-auto">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.js-blog-delete-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                var form = button.closest('.js-blog-delete-form');
                var title = form?.dataset.title || '';

                Swal.fire({
                    title: @json(__('Are you sure?')),
                    text: @json(__('You are about to delete')) + ' "' + title + '". ' + @json(__('This action cannot be undone.')),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: @json(__('Yes, delete it')),
                    cancelButtonText: @json(__('Cancel')),
                    focusCancel: true,
                }).then(function (result) {
                    if (result.isConfirmed && form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
