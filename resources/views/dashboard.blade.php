<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold tracking-tight text-slate-800">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white/70 p-1 shadow-xl shadow-slate-200/40 backdrop-blur-sm">
            <div class="relative overflow-hidden rounded-[1.35rem] bg-gradient-to-br from-slate-50 via-white to-violet-50/40 px-8 py-12 sm:px-12 sm:py-16">
                <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-br from-violet-400/30 to-cyan-400/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-16 h-56 w-56 rounded-full bg-gradient-to-tr from-cyan-400/20 to-transparent blur-2xl"></div>

                <div class="relative max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-widest text-violet-600/90">
                        {{ __('Welcome back') }}
                    </p>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        {{ __('Hello, :name', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="mt-4 text-lg leading-relaxed text-slate-600">
                        You are signed in to the MKPDesign team area. Add project tools, client pages, and renovation workflows here as the product grows.
                    </p>
                    <div class="mt-10 flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 px-4 py-2 text-sm font-medium text-slate-700 ring-1 ring-slate-900/10">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                            </span>
                            {{ __('Session active') }}
                        </span>
                        <span class="inline-flex items-center rounded-full bg-violet-600/10 px-4 py-2 text-sm font-medium text-violet-800 ring-1 ring-violet-600/15">
                            {{ __('Dashboard v1') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
