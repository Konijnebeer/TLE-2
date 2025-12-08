@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm bg-white']) }}>
    {{ $value ?? $slot }}
</label>
