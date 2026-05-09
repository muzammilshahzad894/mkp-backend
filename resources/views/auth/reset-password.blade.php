<x-guest-layout>
    <div class="relative flex min-h-screen flex-col items-center justify-center bg-slate-50 px-4 py-12">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-violet-50/70 via-white to-cyan-50/50"></div>

        <div class="relative w-full max-w-md">
            <div class="mb-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-600 to-cyan-500 text-sm font-bold text-white shadow-lg shadow-violet-500/25">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(config('app.name', 'M'), 0, 1)) }}
                    </span>
                    <span class="text-xl font-bold tracking-tight text-slate-900">{{ config('app.name', 'MKPDesign') }}</span>
                </a>
            </div>

            <div class="glass-panel rounded-3xl border border-white/80 p-px">
                <div class="rounded-[calc(1.5rem-1px)] bg-white/95 p-8 shadow-inner shadow-white/40">
                    <h2 class="text-lg font-bold text-slate-900">{{ __('Reset password') }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ __('Choose a new password for your account.') }}</p>

                    <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-5">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="font-semibold text-slate-800" />
                            <x-text-input id="email" class="mt-2 block w-full rounded-xl border-slate-200/90 bg-slate-50/80 px-4 py-3 focus:border-violet-500 focus:ring-violet-500/15" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" class="font-semibold text-slate-800" />
                            <x-text-input id="password" class="mt-2 block w-full rounded-xl border-slate-200/90 bg-slate-50/80 px-4 py-3 focus:border-violet-500 focus:ring-violet-500/15" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-semibold text-slate-800" />
                            <x-text-input id="password_confirmation" class="mt-2 block w-full rounded-xl border-slate-200/90 bg-slate-50/80 px-4 py-3 focus:border-violet-500 focus:ring-violet-500/15"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end pt-2">
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-violet-500/25 transition hover:shadow-violet-500/35 focus:outline-none focus:ring-4 focus:ring-violet-500/25"
                            >
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-8 text-center text-sm">
                <a href="{{ route('login') }}" class="font-semibold text-violet-600 hover:text-violet-500">{{ __('Back to sign in') }}</a>
            </p>
        </div>
    </div>
</x-guest-layout>
