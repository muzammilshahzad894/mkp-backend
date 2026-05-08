@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-xl border-slate-200 bg-slate-50/50 shadow-sm transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/20']) }}>
