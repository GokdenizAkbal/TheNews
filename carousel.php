



<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="Images/Technology.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="Images/Nature.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="Images/Study.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="text-center mt-3">
    <h3 id="slide-title">Technology</h3>
    <p id="slide-text">
        Explore the latest innovations and trends in the tech world.
    </p>
</div>


<script>

    const titles = [
        "Technology",
        "Nature",
        "Study"
    ];

    const texts = [
        "Explore the latest innovations and trends in the tech world.",
        "Discover the beauty of nature and its wonders.",
        "Tips and resources to improve your learning journey."
    ];


    document.addEventListener('DOMContentLoaded', function() {
        const myCarousel = document.querySelector('#carouselExampleIndicators');

        myCarousel.addEventListener('slid.bs.carousel', function (event) {
            document.getElementById('slide-title').innerText = titles[event.to];
            document.getElementById('slide-text').innerText = texts[event.to];
        });
    });
</script>