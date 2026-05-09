<x-guest-layout>
    <div class="relative flex min-h-screen flex-col items-center justify-center bg-slate-50 px-4 py-12">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-violet-50/70 via-white to-cyan-50/50"></div>
        <div class="pointer-events-none absolute left-1/2 top-12 h-64 w-[28rem] -translate-x-1/2 rounded-full bg-violet-400/15 blur-3xl"></div>

        <div class="relative w-full max-w-md">
            <div class="mb-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-600 to-cyan-500 text-sm font-bold text-white shadow-lg shadow-violet-500/25">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(config('app.name', 'M'), 0, 1)) }}
                    </span>
                    <span class="text-xl font-bold tracking-tight text-slate-900">{{ config('app.name', 'MKPDesign') }}</span>
                </a>
            </div>

            <div class="mb-4 text-center text-sm leading-relaxed text-slate-600">
                {{ __('Forgot your password? Enter your email and we will send a link to choose a new one.') }}
            </div>

            @if (session('status'))
                <p class="mb-4 rounded-xl border border-emerald-200/80 bg-emerald-50 px-4 py-3 text-center text-sm font-medium text-emerald-800">{{ session('status') }}</p>
            @endif

            <div class="glass-panel rounded-3xl border border-white/80 p-px">
                <form method="POST" action="{{ route('password.email') }}" class="rounded-[calc(1.5rem-1px)] bg-white/95 p-8 shadow-inner shadow-white/40">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-800">{{ __('Email') }}</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="mt-2 block w-full rounded-xl border border-slate-200/90 bg-slate-50/80 px-4 py-3 text-slate-900 transition focus:border-violet-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-500/15"
                        >
                        @error('email')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-violet-500/25 transition hover:shadow-violet-500/35 focus:outline-none focus:ring-4 focus:ring-violet-500/25"
                        >
                            {{ __('Email password reset link') }}
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-sm">
                <a href="{{ route('login') }}" class="font-semibold text-violet-600 hover:text-violet-500">{{ __('Back to sign in') }}</a>
            </p>
        </div>
    </div>
</x-guest-layout>
