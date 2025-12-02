@props([
    'heading' => 'Default Heading'
])

<div class="infobox-container">
    <div class="infobox-heading">
        <h2>{{ $heading }}</h2>
    </div>
    <div class="infobox-content"><br>{{ $slot }}</div>
</div>
