@props([
    'variant' => 'primary',
    'size' => 'medium'
])

@php
    $baseClass = 'rounded-sm';

    $variantClass = [
        'primary' => 'bg-[--button-primary-color] text-[--color-white]',
        'secondary' => ''
    ];

    $sizeClass = [
        'small' => '',
        'medium' => '',
        'large' => ''
    ];

$classes = $baseClass . ' ' . $variantClass[$variant] . ' ' . $sizeClass[$size];
@endphp

<button class="{{ $classes }}">
    {{ $slot }}
</button>
