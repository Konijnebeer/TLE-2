<!DOCTYPE html>
<html>
<head>
    <title>Foto Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        @foreach ($images as $index => $image)
            <button type="button"
                    data-bs-target="#photoCarousel"
                    data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}"
                    aria-current="{{ $index == 0 ? 'true' : '' }}"
                    aria-label="Slide {{ $index+1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach ($images as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('images/' . $image) }}" class="d-block w-100" alt="Foto {{ $index+1 }}">
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
