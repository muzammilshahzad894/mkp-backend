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
                    <div class="text-sm leading-relaxed text-slate-600">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mt-4 rounded-xl border border-emerald-200/80 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-violet-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-violet-500/25 transition hover:shadow-violet-500/35 focus:outline-none focus:ring-4 focus:ring-violet-500/25 sm:w-auto"
                            >
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-center text-sm font-semibold text-slate-600 underline-offset-4 transition hover:text-slate-900 hover:underline sm:w-auto">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
