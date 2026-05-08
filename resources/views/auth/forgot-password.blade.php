<x-guest-layout>
    <div class="mb-8 text-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tight text-slate-900">MKPDesign</a>
    </div>

    <div class="mb-4 text-center text-sm text-slate-600">
        Forgot your password? Enter your email and we will send a link to choose a new one.
    </div>

    @if (session('status'))
        <p class="mb-4 text-sm font-medium text-emerald-700">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="rounded-2xl border border-slate-200/80 bg-white p-8 shadow-xl shadow-slate-200/50">
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
                class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2 shadow-sm transition focus:border-violet-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20"
            >
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center justify-end">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl border border-transparent bg-gradient-to-r from-violet-600 to-violet-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-violet-500/25 transition hover:from-violet-500 hover:to-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2"
            >
                Email password reset link
            </button>
        </div>
    </form>
</x-guest-layout>
