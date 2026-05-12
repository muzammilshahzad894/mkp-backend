@extends('layouts.app')

@section('header')
        <div class="flex min-w-0 flex-col gap-0.5">
            <h1 class="truncate text-lg font-semibold tracking-tight text-slate-900">
                {{ __('Dashboard') }}
            </h1>
            <p class="hidden text-xs font-medium text-slate-500 sm:block">
                {{ now()->translatedFormat('l, j F Y') }}
            </p>
        </div>
@endsection

@section('content')
        {{-- Hero welcome --}}
        <div class="relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-200/40 ring-1 ring-slate-900/[0.03]">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-violet-600/[0.07] via-transparent to-cyan-500/[0.08]"></div>
            <div class="pointer-events-none absolute -right-24 top-0 h-72 w-72 rounded-full bg-gradient-to-br from-violet-400/25 to-cyan-400/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 left-10 h-56 w-56 rounded-full bg-gradient-to-tr from-cyan-400/15 to-transparent blur-2xl"></div>

            <div class="relative grid gap-10 p-8 sm:p-10 lg:grid-cols-[1fr_auto] lg:items-center lg:gap-12 lg:p-12">
                <div class="min-w-0">
                    <div class="inline-flex items-center gap-2 rounded-full bg-slate-900/[0.04] px-3 py-1 text-xs font-semibold uppercase tracking-wider text-violet-700 ring-1 ring-slate-900/[0.06]">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        </span>
                        {{ __('Live workspace') }}
                    </div>

                    <h2 class="font-display mt-5 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-[2.35rem] lg:leading-tight">
                        {{ __('Hello, :name', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="mt-4 max-w-xl text-base leading-relaxed text-slate-600 sm:text-lg">
                        {{ __('You are signed in. This is your home base—use the sidebar when you add more sections. For now, relax and enjoy the view.') }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-sm ring-1 ring-slate-200/80">
                            <svg class="h-5 w-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ __('Authenticated') }}
                        </span>
                        <span class="inline-flex items-center rounded-2xl bg-gradient-to-r from-violet-600/10 to-cyan-500/10 px-4 py-2.5 text-sm font-semibold text-violet-900 ring-1 ring-violet-500/15">
                            {{ __('Dashboard v1') }}
                        </span>
                    </div>
                </div>

                {{-- Decorative panel --}}
                <div class="relative hidden w-full max-w-[17rem] shrink-0 lg:block">
                    <div class="animate-float relative rounded-3xl border border-white/60 bg-gradient-to-br from-slate-900 via-slate-900 to-violet-950 p-6 text-white shadow-2xl shadow-violet-900/30 ring-1 ring-white/10">
                        <div class="pointer-events-none absolute inset-0 rounded-3xl bg-[radial-gradient(circle_at_30%_20%,rgba(167,139,250,0.35),transparent_55%)]"></div>
                        <p class="relative text-xs font-semibold uppercase tracking-widest text-violet-200/90">
                            {{ __('Snapshot') }}
                        </p>
                        <p class="relative mt-6 font-display text-4xl font-bold tabular-nums tracking-tight">
                            100<span class="text-lg font-semibold text-violet-200/80">%</span>
                        </p>
                        <p class="relative mt-1 text-sm text-slate-400">
                            {{ __('Ready for your next pages') }}
                        </p>
                        <div class="relative mt-8 space-y-3">
                            <div class="h-2 overflow-hidden rounded-full bg-white/10">
                                <div class="h-full w-full rounded-full bg-gradient-to-r from-violet-400 to-cyan-400"></div>
                            </div>
                            <div class="flex justify-between text-xs font-medium text-slate-500">
                                <span>{{ __('Layout') }}</span>
                                <span class="text-emerald-300">{{ __('Online') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Placeholder row -- subtle, not fake navigation --}}
        <div class="mt-8 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-dashed border-slate-200/90 bg-white/60 p-6 ring-1 ring-slate-900/[0.02] backdrop-blur-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <p class="mt-4 text-sm font-semibold text-slate-800">{{ __('More modules') }}</p>
                <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ __('Wire new screens here when you are ready.') }}</p>
            </div>
            <div class="rounded-2xl border border-dashed border-slate-200/90 bg-white/60 p-6 ring-1 ring-slate-900/[0.02] backdrop-blur-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                </div>
                <p class="mt-4 text-sm font-semibold text-slate-800">{{ __('Layouts') }}</p>
                <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ __('Keep sections consistent as the app grows.') }}</p>
            </div>
            <div class="rounded-2xl border border-dashed border-slate-200/90 bg-white/60 p-6 ring-1 ring-slate-900/[0.02] backdrop-blur-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <p class="mt-4 text-sm font-semibold text-slate-800">{{ __('Performance') }}</p>
                <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ __('Fast Blade views and lean assets by default.') }}</p>
            </div>
        </div>
    </div>
@endsection
