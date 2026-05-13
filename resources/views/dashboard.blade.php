@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    @php
        $hour = now()->hour;

        $greeting = $hour < 12
            ? __('Good Morning')
            : ($hour < 17
                ? __('Good Afternoon')
                : __('Good Evening'));

        $message = $hour < 12
            ? __('Start your day with clarity and focus.')
            : ($hour < 17
                ? __('Hope your work is going smoothly.')
                : __('Great work today. Time to wrap things up.'));
    @endphp

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ── Hero Welcome Card ── --}}
            <div
                class="relative overflow-hidden rounded-2xl"
                style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 55%, #0f172a 100%); padding: 48px 52px;"
            >
                {{-- Dot-grid overlay --}}
                <div class="pointer-events-none absolute inset-0"
                     style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.045) 1px, transparent 0); background-size: 28px 28px;"></div>

                {{-- Violet glow top-right --}}
                <div class="pointer-events-none absolute rounded-full"
                     style="top:-90px; right:-90px; width:300px; height:300px;
                            background: radial-gradient(circle, rgba(139,92,246,0.30) 0%, transparent 68%);"></div>

                {{-- Indigo glow bottom-left --}}
                <div class="pointer-events-none absolute rounded-full"
                     style="bottom:-70px; left:-70px; width:240px; height:240px;
                            background: radial-gradient(circle, rgba(99,102,241,0.20) 0%, transparent 68%);"></div>

                {{-- Content row --}}
                <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">

                    {{-- Left: greeting --}}
                    <div>
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-widest"
                            style="border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); color: #94a3b8; letter-spacing: 0.1em;"
                        >
                            ✦ {{ __('Welcome Back') }}
                        </span>

                        <h1 class="mt-5 text-4xl font-bold tracking-tight" style="color:#ffffff; line-height:1.15;">
                            {{ $greeting }},
                        </h1>
                        <p class="text-4xl font-bold tracking-tight mt-1" style="color:#c4b5fd; line-height:1.15;">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="mt-5 text-sm leading-relaxed" style="color:#94a3b8; max-width:340px;">
                            {{ $message }}
                        </p>
                    </div>

                    {{-- Right: date badge --}}
                    <div
                        class="shrink-0 rounded-xl text-right"
                        style="border: 1px solid rgba(255,255,255,0.10); background: rgba(255,255,255,0.06); padding: 18px 26px; backdrop-filter: blur(8px);"
                    >
                        <p class="text-xs uppercase tracking-widest mb-1" style="color:#64748b; letter-spacing:0.12em;">
                            {{ __('Today') }}
                        </p>
                        <p class="text-sm font-bold" style="color:#ffffff;">
                            {{ now()->translatedFormat('l') }}
                        </p>
                        <p class="text-xs mt-1" style="color:#94a3b8;">
                            {{ now()->translatedFormat('j F Y') }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- ── Info Cards ── --}}

            {{-- Row 1: Profile + Status side by side on lg+ --}}
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

                {{-- Profile Card --}}
                <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl"
                        style="background: linear-gradient(135deg, #8b5cf6, #4f46e5); box-shadow: 0 6px 18px rgba(139,92,246,0.28);"
                    >
                        <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">
                            {{ __('Logged in as') }}
                        </p>
                        <h2 class="mt-1 truncate text-lg font-bold text-slate-900">
                            {{ Auth::user()->name }}
                        </h2>
                    </div>
                </div>

                {{-- Account Status Card --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">
                        {{ __('Account Status') }}
                    </p>
                    <div class="mt-3 flex items-center gap-2.5">
                        <span class="relative flex h-2.5 w-2.5 shrink-0">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                        </span>
                        <span class="text-sm font-bold text-emerald-700">{{ __('Active & Secure') }}</span>
                    </div>
                    <p class="mt-2 text-xs text-slate-400">
                        {{ __('Your session is protected and verified.') }}
                    </p>
                </div>

            </div>

            {{-- Row 2: Email full width --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">
                            {{ __('Email Address') }}
                        </p>
                        <p class="mt-1.5 truncate text-sm font-medium text-slate-800">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <div class="shrink-0 rounded-xl bg-slate-100 p-3">
                        <svg class="h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection