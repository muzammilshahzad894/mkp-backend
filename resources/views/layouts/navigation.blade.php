{{-- Mobile overlay --}}
<div
    x-cloak
    x-show="sidebarOpen"
    x-transition.opacity
    class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"
    style="display: none;"
    @click="sidebarOpen = false"
></div>

<aside
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-white/[0.06] bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 shadow-2xl shadow-slate-950/55 ring-1 ring-white/[0.04] transition-transform duration-200 ease-out"
    x-bind:class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen,
        'lg:translate-x-0': !sidebarCollapsed,
        'lg:-translate-x-full': sidebarCollapsed,
    }"
>
    <div class="flex h-16 shrink-0 items-center gap-3 border-b border-white/5 px-5">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-cyan-400 text-lg font-bold text-white shadow-lg shadow-violet-500/30">
            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(config('app.name', 'M'), 0, 1)) }}
        </div>
        <div class="min-w-0 flex-1">
            <p class="truncate text-sm font-semibold text-white">{{ config('app.name', 'MKPDesign') }}</p>
            <p class="truncate text-xs font-medium text-slate-500">{{ __('Navigation') }}</p>
        </div>
        <button
            type="button"
            class="rounded-lg p-2 text-slate-400 hover:bg-white/5 hover:text-white lg:hidden"
            @click="sidebarOpen = false"
        >
            <span class="sr-only">Close menu</span>
            <i class="fa-solid fa-xmark text-lg leading-none" aria-hidden="true"></i>
        </button>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
        @php
            $dashboardActive = request()->routeIs('dashboard');
            $dashboardLinkClass = $dashboardActive
                ? 'flex items-center gap-3 rounded-xl bg-gradient-to-r from-violet-500/20 to-cyan-500/10 px-4 py-3 text-sm font-semibold text-white ring-1 ring-white/10 shadow-lg shadow-violet-500/10'
                : 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white';
            $blogsActive = request()->routeIs('blogs.*');
            $blogsLinkClass = $blogsActive
                ? 'flex items-center gap-3 rounded-xl bg-gradient-to-r from-violet-500/20 to-cyan-500/10 px-4 py-3 text-sm font-semibold text-white ring-1 ring-white/10 shadow-lg shadow-violet-500/10'
                : 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white';
        @endphp
        <a href="{{ route('dashboard') }}" class="{{ $dashboardLinkClass }}" @click="sidebarOpen = false">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/5 text-cyan-300 ring-1 ring-white/10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </span>
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('blogs.index') }}" class="{{ $blogsLinkClass }}" @click="sidebarOpen = false">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/5 text-cyan-300 ring-1 ring-white/10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </span>
            {{ __('Blog') }}
        </a>
    </nav>
</aside>
