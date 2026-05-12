<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">{{ __('Current Password') }}</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20"
            >
            @if ($errors->updatePassword->get('current_password'))
                <ul class="mt-2 space-y-1 text-sm text-red-600">
                    @foreach ((array) $errors->updatePassword->get('current_password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700">{{ __('New Password') }}</label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20"
            >
            @if ($errors->updatePassword->get('password'))
                <ul class="mt-2 space-y-1 text-sm text-red-600">
                    @foreach ((array) $errors->updatePassword->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20"
            >
            @if ($errors->updatePassword->get('password_confirmation'))
                <ul class="mt-2 space-y-1 text-sm text-red-600">
                    @foreach ((array) $errors->updatePassword->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center rounded-xl border border-transparent bg-gradient-to-r from-violet-600 to-violet-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-lg shadow-violet-500/25 transition hover:from-violet-500 hover:to-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 active:scale-[0.98]">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
