@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Heading -->
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-primary">About Our Startup</h1>
        <p class="lead text-muted">Transforming aspiring developers into industry-ready full stack professionals.</p>
    </div>

    <!-- About Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <p class="lead text-justify">
                Our startup is an innovative platform that helps you become a talented <strong>Full Stack Developer</strong> at an advanced level through comprehensive courses. Our mission is to prepare every aspiring developer for the industry so they can secure their dream job.
            </p>
            <p class="lead text-justify">
                We don't just teach basic skills; we equip you with real-world projects, advanced programming techniques, and expertise in the latest technologies. Our goal is to identify the best developers from our students and include them in our team, so that you too can become a top industry professional.
            </p>
        </div>
    </div>

    <!-- Vision & Goal -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="text-success mb-3">Our Vision</h3>
            <p class="text-justify">
                Our aim is to provide high-quality, practical training to elevate your skills to the next level. We want you not just to learn but to get your first opportunity in the industry.
            </p>
        </div>
        <div class="col-md-6">
            <h3 class="text-success mb-3">Our Goal</h3>
            <p class="text-justify">
                Our goal is to develop talented developers who are experts in their field. We don't just teach you; we give you the chance to be part of our team, work on real projects, and earn.
            </p>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="#enroll" class="btn btn-primary btn-lg">Join Our Journey Today</a>
        </div>
    </div>
</div>
@endsection