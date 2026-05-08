<x-guest-layout>
    <div class="mb-8 text-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tight text-slate-900">MKPDesign</a>
    </div>

    @if (session('status'))
        <p class="mb-4 text-center text-sm font-medium text-emerald-700">{{ session('status') }}</p>
    @endif

    <div class="rounded-2xl border border-slate-200/80 bg-white p-8 shadow-lg">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between gap-4">
                <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-violet-600 shadow-sm focus:ring-violet-500" name="remember">
                    <span class="text-sm text-slate-600">Remember me</span>
                </label>
                <a class="text-sm font-medium text-violet-600 hover:text-violet-500" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            </div>

            <div>
                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-transparent bg-gradient-to-r from-violet-600 to-violet-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-500/25 transition hover:from-violet-500 hover:to-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 active:scale-[0.98]"
                >
                    Log in
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
