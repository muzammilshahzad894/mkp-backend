@props(['active' => false])

@php
    $classes = $active
        ? 'flex items-center gap-3 rounded-xl bg-gradient-to-r from-violet-500/20 to-cyan-500/10 px-4 py-3 text-sm font-semibold text-white ring-1 ring-white/10 shadow-lg shadow-violet-500/10'
        : 'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
