@extends('layouts.app')

@section('content')
@include('include/alert')

<!-- Start Content-->
<div class="container-fluid">
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                @if(Auth::check())
                <h1 class="text-info mb-0">Welcome, {{ $user->name ?? 'New User' }}!</h1>
                @else
                <h4 class="page-title font-weight-bold mb-0">DASHBOARD</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Slider Section -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <!-- First Slide -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                    <img src="{{ asset('assets/images/slider/Full-Stack-Developer-1.webp') }}"
                        class="d-block w-100"
                        style="max-height: 400px; width:100% object-fit: contain;"
                        alt="First slide">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>First Slider Label</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>

            <!-- Second Slide -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/images/slider/Full-stack-developer-vs-software-developer.png') }}"
                        class="d-block w-100"
                        style="max-height: 400px; width:100% object-fit: contain;"
                        alt="Second slide">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second Slider Label</h5>
                    <p>Doloremque dolorem voluptate. Doloremque dolorem voluptate.</p>
                </div>
            </div>

            <!-- Third Slide -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                    <img src="{{ asset('assets/images/slider/Full-stack-developer.png') }}"
                        class="d-block w-100"
                        style="max-height: 400px; width:100% object-fit: contain;"
                        alt="Third slide">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third Slider Label</h5>
                    <p>Dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- End Slider -->

    <!-- Additional Features Section -->
    <div class="row mt-3">
        <!-- Feature 1: Quick Stats -->
        <div class="col-md-4">
            <div class="card mb-1">
                <div class="card-body">
                    <h5 class="card-title mb-1">Quick Stats</h5>
                    <p class="card-text">Display some quick statistics here.</p>
                    <!-- Add your quick stats content here -->
                </div>
            </div>
        </div>

        <!-- Feature 2: Recent Activity -->
        <div class="col-md-4">
            <div class="card mb-1">
                <div class="card-body">
                    <h5 class="card-title mb-1">Recent Activity</h5>
                    <p class="card-text">Show recent activities or notifications.</p>
                    <!-- Add your recent activity content here -->
                </div>
            </div>
        </div>

        <!-- Feature 3: Useful Links -->
        <div class="col-md-4">
            <div class="card mb-1">
                <div class="card-body">
                    <h5 class="card-title mb-1">Useful Links</h5>
                    <p class="card-text">Provide some useful links for developers.</p>
                    <!-- Add your useful links content here -->
                </div>
            </div>
        </div>
    </div>

    @if(!$user)
    <div class="text-center mt-2">
        <!-- Button to trigger modal -->
        <!-- <button type="button" class="btn btn-info rounded-lg" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="$('#loginModal').modal('show')">Please Login....</button> -->
        <button type="button" class="btn btn-info rounded-lg">
            <a href="/login" class="text-white">Please Login</a>
        </button>
    </div>
    @endif
</div>

<!-- Add this script to handle the modal -->
<!-- <script>
    $(document).ready(function() {
        // Initialize the modal
        $('#loginModal').modal({
            show: false
        });
    });
</script> -->
@endsection
