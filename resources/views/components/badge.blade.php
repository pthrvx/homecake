@props(['tone' => 'sage'])
@php $c = ['sage' => 'bg-sage', 'butter' => 'bg-butter', 'warn' => 'bg-red-100 text-red-800'][$tone] ?? 'bg-sage'; @endphp
<span {{ $attributes->merge(['class' => "rounded-full px-3 py-1 text-xs font-semibold $c"]) }}>{{ $slot }}</span>
