<!--Sliders-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('slider/carousel1.png') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First Slider Label</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('slider/carousel2.png') }}" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second Slider Label</h5>
                    <p>Doloremque dolorem voluptate. Doloremque dolorem voluptate.</p>
                </div>
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('slider/carousel3.png') }}" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third Slider Label</h5>
                    <p>dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
</div>
<!--End Slider-->
