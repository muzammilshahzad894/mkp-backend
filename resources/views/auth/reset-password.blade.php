@extends('layouts.guest')

@section('content')
    <div
        class="login-screen font-login relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-5 py-14 text-white"
        style="background-color: #4a69bd;"
    >
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_78%_58%_at_50%_38%,rgba(255,255,255,0.14)_0%,transparent_58%)]"
            aria-hidden="true"
        ></div>
        <div
            class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_105%,rgba(35,52,110,0.45)_0%,transparent_52%)]"
            aria-hidden="true"
        ></div>

        <div class="relative mx-auto w-full max-w-[380px]">
            <div
                class="relative rounded-[1.75rem] border border-white/30 pt-[3.35rem] shadow-[0_28px_56px_-18px_rgba(18,28,62,0.58)] backdrop-blur-xl ring-1 ring-white/12"
                style="background: linear-gradient(152deg, rgba(91, 127, 212, 0.52) 0%, rgba(52, 76, 148, 0.78) 48%, rgba(38, 58, 118, 0.88) 100%);"
            >
                <div class="pointer-events-none absolute inset-0 rounded-[1.75rem] bg-gradient-to-t from-black/[0.07] to-transparent" aria-hidden="true"></div>

                <div class="absolute left-1/2 top-0 z-10 -translate-x-1/2 -translate-y-1/2">
                    <div
                        class="flex h-[5.25rem] w-[5.25rem] items-center justify-center rounded-full border-[3px] border-white/45 bg-white/20 shadow-[0_14px_32px_-10px_rgba(24,38,78,0.55)] backdrop-blur-md ring-4 ring-[#263a76]/35"
                    >
                        {{-- FA icon replaces SVG lock icon --}}
                        <i class="fa-solid fa-lock text-[2rem] text-white/95" aria-hidden="true"></i>
                    </div>
                </div>

                <div
                    class="relative px-8 pb-10 pt-1 sm:px-10"
                    x-data="{ submitting: false, errorDismissed: false, showPassword: false, showPasswordConfirm: false }"
                    x-init="window.addEventListener('pageshow', () => { submitting = false })"
                >
                    <div class="text-center">
                        <h1 class="text-xl font-semibold tracking-tight text-white sm:text-[1.35rem]">
                            MKPDesign
                        </h1>
                        <p class="mt-1.5 text-[0.8125rem] font-medium text-white/65">
                            {{ __('Choose a new password') }}
                        </p>
                    </div>

                    @if ($errors->any())
                        <div
                            x-show="!errorDismissed"
                            x-transition.opacity.duration.200ms
                            class="login-alert-error mt-7"
                            role="alert"
                        >
                            <span class="login-alert-error__icon" aria-hidden="true">
                                {{-- FA icon replaces SVG warning triangle --}}
                                <i class="fa-solid fa-triangle-exclamation text-[0.875rem]" aria-hidden="true"></i>
                            </span>
                            <div class="login-alert-error__body">
                                @foreach ($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                            <button
                                type="button"
                                class="login-alert-dismiss"
                                @click="errorDismissed = true"
                                aria-label="{{ __('Dismiss error') }}"
                            >
                                {{-- FA icon replaces SVG X icon --}}
                                <i class="fa-solid fa-xmark h-4 w-4 shrink-0" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('password.store') }}"
                        class="mt-8 space-y-5"
                        @submit="submitting = true"
                    >
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="login-field-group">
                            <label for="email" class="login-label">{{ __('Email') }}</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="name@company.com"
                                class="login-field @error('email') login-field-invalid @enderror"
                            >
                        </div>

                        <div class="login-field-group">
                            <label for="password" class="login-label">{{ __('Password') }}</label>
                            <div class="relative w-full">
                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="{{ __('New password') }}"
                                    class="login-field w-full !pr-12 @error('password') login-field-invalid @enderror"
                                >
                                <button
                                    type="button"
                                    class="absolute inset-y-0 right-0 flex h-full w-11 items-center justify-end pr-3 rounded-r-xl text-white/70 outline-none transition-colors hover:text-white focus-visible:ring-2 focus-visible:ring-white/35"
                                    @click="showPassword = !showPassword"
                                    :aria-label="showPassword ? '{{ __('Hide password') }}' : '{{ __('Show password') }}'"
                                >
                                    <i
                                        class="fa-solid text-[1.05rem] leading-none mr-2"
                                        :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </div>
                        </div>

                        <div class="login-field-group">
                            <label for="password_confirmation" class="login-label">{{ __('Confirm password') }}</label>
                            <div class="relative w-full">
                                <input
                                    id="password_confirmation"
                                    :type="showPasswordConfirm ? 'text' : 'password'"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="{{ __('Confirm new password') }}"
                                    class="login-field w-full !pr-12 @error('password_confirmation') login-field-invalid @enderror"
                                >
                                <button
                                    type="button"
                                    class="absolute inset-y-0 right-0 flex h-full w-11 items-center justify-end pr-3 rounded-r-xl text-white/70 outline-none transition-colors hover:text-white focus-visible:ring-2 focus-visible:ring-white/35"
                                    @click="showPasswordConfirm = !showPasswordConfirm"
                                    :aria-label="showPasswordConfirm ? '{{ __('Hide password') }}' : '{{ __('Show password') }}'"
                                >
                                    <i
                                        class="fa-solid text-[1.05rem] leading-none mr-2"
                                        :class="showPasswordConfirm ? 'fa-eye-slash' : 'fa-eye'"
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="login-btn mt-1" :disabled="submitting">
                            <span x-show="!submitting" class="inline-flex items-center justify-center gap-2">
                                {{ __('Reset password') }}
                            </span>
                            <span x-cloak x-show="submitting" class="inline-flex items-center justify-center gap-2">
                                <svg class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ __('Saving…') }}</span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a
                    href="{{ route('login') }}"
                    class="text-[0.875rem] font-medium text-white/90 transition hover:text-white hover:underline hover:underline-offset-4"
                >
                    {{ __('Back to sign in') }}
                </a>
            </div>
        </div>
    </div>
@endsection