<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Slideshow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<body>
<h1>[[ APPNAME ]]</h1>

<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/public/images/image_1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/public/images/image_2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/public/images/image_3.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/public/images/image_4.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/public/images/image_5.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

</body>
</html>
