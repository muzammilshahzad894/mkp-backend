<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title.' — ' : '' }}{{ config('app.name', 'MKPDesign') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|syne:600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased text-slate-900">
        <div class="min-h-full" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
            @include('layouts.navigation')

            <div
                class="transition-[padding] duration-200 ease-out"
                :class="sidebarCollapsed ? 'lg:pl-0' : 'lg:pl-64'"
            >
                <header class="sticky top-0 z-30 flex h-16 shrink-0 items-center justify-between gap-3 border-b border-slate-200/70 bg-white/80 px-4 shadow-sm shadow-slate-200/30 backdrop-blur-xl supports-[backdrop-filter]:bg-white/70">
                    <div class="flex min-w-0 flex-1 items-center gap-2 sm:gap-3">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2.5 text-slate-700 shadow-sm hover:bg-slate-50 lg:hidden"
                            @click="sidebarOpen = true"
                        >
                            <span class="sr-only">Open menu</span>
                            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>

                        <button
                            type="button"
                            class="hidden items-center justify-center rounded-xl border border-slate-200 bg-white p-2.5 text-slate-700 shadow-sm hover:bg-slate-50 lg:inline-flex"
                            @click="sidebarCollapsed = !sidebarCollapsed"
                            :title="sidebarCollapsed ? 'Show sidebar' : 'Hide sidebar'"
                        >
                            <span class="sr-only" x-text="sidebarCollapsed ? 'Show sidebar' : 'Hide sidebar'"></span>
                            <svg class="h-5 w-5 transition-transform duration-200" :class="{ 'rotate-180': sidebarCollapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                            </svg>
                        </button>

                        @hasSection('header')
                            <div class="min-w-0 border-l border-slate-200 pl-3 sm:pl-4">
                                @yield('header')
                            </div>
                        @endif
                    </div>

                    <div class="flex shrink-0 items-center">
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                            <div @click="open = ! open">
                                <button
                                    type="button"
                                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2 py-1.5 text-left shadow-sm hover:bg-slate-50 sm:px-3"
                                >
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-violet-600 to-cyan-500 text-xs font-semibold text-white">
                                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                    <span class="hidden max-w-[10rem] truncate text-sm font-medium text-slate-800 sm:block">{{ Auth::user()->name }}</span>
                                    <svg class="h-4 w-4 shrink-0 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>

                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute end-0 z-50 mt-2 w-48 origin-top-right rounded-md shadow-lg rtl:origin-top-left"
                                style="display: none;"
                                @click="open = false"
                            >
                                <div class="rounded-md bg-white py-1 shadow-lg ring-1 ring-slate-200 ring-black/5">
                                    <div class="border-b border-slate-100 px-4 py-2 sm:hidden">
                                        <p class="truncate text-sm font-medium text-slate-900">{{ Auth::user()->name }}</p>
                                        <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a
                                            href="{{ route('logout') }}"
                                            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                        >
                                            Log out
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="relative min-h-[calc(100vh-4rem)]">
                    <div class="mesh-bg pointer-events-none absolute inset-0 opacity-90" aria-hidden="true"></div>
                    <div class="relative z-10">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
