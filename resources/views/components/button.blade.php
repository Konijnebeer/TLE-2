@props([
    'variant' => 'primary',
    'size' => 'medium',
    'arrow' => true
])

@php
    $baseClass = 'rounded-sm w-full';

    $variantClass = [
        'primary' => 'bg-[--button-primary-color] text-[--color-white]',
        'secondary' => 'bg-[--button-secondary-color] text-[--color-white]',
        'transparent' => 'text-[--color-black]',
        'answer' => 'bg-[#89b934] text-[--color-black]'
    ];

    $sizeClass = [
        'small' => 'px-4 py-2 text-base',
        'medium' => 'px-6 py-3 text-xl',
        'large' => 'px-8 py-4 text-2xl'
    ];

$classes = $baseClass . ' ' . $variantClass[$variant] . ' ' . $sizeClass[$size];
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if($arrow)
        <i class="fa-solid fa-arrow-right pl-2"></i>
    @endif
</button>
