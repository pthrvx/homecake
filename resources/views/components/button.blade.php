@props(['href' => null, 'variant' => 'primary'])
@php $c = 'inline-flex min-h-11 items-center justify-center rounded-full px-6 py-2.5 font-semibold transition '.($variant === 'primary' ? 'bg-terra text-white hover:bg-cocoa' : 'border border-cocoa text-cocoa hover:bg-cocoa hover:text-cream'); @endphp
@if($href)<a href="{{ $href }}" {{ $attributes->merge(['class' => $c]) }}>{{ $slot }}</a>
@else<button {{ $attributes->merge(['class' => $c, 'type' => 'submit']) }}>{{ $slot }}</button>@endif
