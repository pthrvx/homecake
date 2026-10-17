@props(['name', 'label', 'type' => 'text', 'value' => null])
<div>
  <label for="{{ $name }}" class="mb-1 block text-sm font-medium">{{ $label }}</label>
  <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => 'field']) }}>
  @error($name)<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
</div>
