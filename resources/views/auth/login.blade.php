<x-guest-layout>
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
                        <svg class="h-[2.85rem] w-[2.85rem] text-white/95" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 11.25c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm-7.5 8.25v-.375c0-2.486 3.474-3.75 7.5-3.75s7.5 1.264 7.5 3.75V19.5h-15z"/>
                        </svg>
                    </div>
                </div>

                <div
                    class="relative px-8 pb-10 pt-1 sm:px-10"
                    x-data="{ submitting: false, errorDismissed: false, successDismissed: false }"
                    x-init="window.addEventListener('pageshow', () => { submitting = false })"
                >
                    <div class="text-center">
                        <h1 class="text-xl font-semibold tracking-tight text-white sm:text-[1.35rem]">
                            MKPDesign
                        </h1>
                        <p class="mt-1.5 text-[0.8125rem] font-medium text-white/65">
                            {{ __('Sign in to continue') }}
                        </p>
                    </div>

                    @if (session('status'))
                        <div
                            x-show="!successDismissed"
                            x-transition.opacity.duration.200ms
                            class="login-alert-success mt-7"
                            role="status"
                        >
                            <p>{{ session('status') }}</p>
                            <button
                                type="button"
                                class="login-alert-dismiss"
                                @click="successDismissed = true"
                                aria-label="{{ __('Dismiss notification') }}"
                            >
                                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            x-show="!errorDismissed"
                            x-transition.opacity.duration.200ms
                            class="login-alert-error mt-7"
                            role="alert"
                        >
                            <span class="login-alert-error__icon" aria-hidden="true">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.25" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                </svg>
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
                                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="mt-8 space-y-5"
                        @submit="submitting = true"
                    >
                        @csrf

                        <div class="login-field-group">
                            <label for="email" class="login-label">{{ __('Email') }}</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="name@company.com"
                                class="login-field @error('email') login-field-invalid @enderror"
                            >
                        </div>

                        <div class="login-field-group">
                            <label for="password" class="login-label">{{ __('Password') }}</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="{{ __('Enter your password') }}"
                                class="login-field @error('password') login-field-invalid @enderror"
                            >
                        </div>

                        <button type="submit" class="login-btn mt-1" :disabled="submitting">
                            <span x-show="!submitting" class="inline-flex items-center justify-center gap-2">
                                {{ __('Sign in') }}
                            </span>
                            <span x-cloak x-show="submitting" class="inline-flex items-center justify-center gap-2">
                                <svg class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ __('Signing in…') }}</span>
                            </span>
                        </button>

                        <label for="remember_me" class="flex cursor-pointer items-center gap-2.5 pt-0.5 select-none">
                            <input id="remember_me" type="checkbox" name="remember" class="login-check" :disabled="submitting">
                            <span class="text-[0.875rem] font-normal text-white/85">{{ __('Remember this device') }}</span>
                        </label>
                    </form>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a
                    href="{{ route('password.request') }}"
                    class="text-[0.875rem] font-medium text-white/90 transition hover:text-white hover:underline hover:underline-offset-4"
                >
                    {{ __('Forgot password?') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
