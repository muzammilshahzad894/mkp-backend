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

    <div class="py-12">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

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

        </div>
    </div>
@endsection