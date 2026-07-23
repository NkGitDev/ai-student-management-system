@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="container my-4">
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-primary">Our Courses</h1>
        <p class="lead text-muted">Learn the latest frontend, backend, and full stack development courses to boost your career.</p>
    </div>

    <!-- Courses Section -->
    <div class="row">

        <!-- Frontend Courses -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="card-title mb-0">Frontend Development</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-3 text-muted">HTML, CSS, JavaScript, React</h5>
                    <p class="card-text">
                        Master the art of creating beautiful and responsive user interfaces. Our frontend course covers HTML5, CSS3, JavaScript, and popular frameworks like React.js.
                    </p>
                    <ul>
                        <li>HTML5 & Semantic Tags</li>
                        <li>CSS Flexbox & Grid</li>
                        <li>JavaScript ES6+</li>
                        <li>React.js Fundamentals</li>
                        <li>Building Interactive UI</li>
                    </ul>
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('add-student', ['course' => 'Frontend']) }}" wire:navigate class="btn btn-primary" wire:click.prevent="setCourse('Frontend')">Enroll Now</a>
                </div>
            </div>
        </div>

        <!-- Backend Courses -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-success">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="card-title mb-0">Backend Development</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-3 text-muted">PHP, Laravel, Node.js, Python</h5>
                    <p class="card-text">
                        Build robust server-side applications. Our backend course includes PHP, Laravel framework, Node.js, and Python for full-stack development.
                    </p>
                    <ul>
                        <li>PHP & Laravel Framework</li>
                        <li>RESTful API Development</li>
                        <li>Node.js & Express.js</li>
                        <li>Database Integration (MySQL, MongoDB)</li>
                        <li>Authentication & Security</li>
                    </ul>
                </div>
                <div class="card-footer bg-light text-center">
                    <a  href="{{ route('add-student', ['course' => 'Backend']) }}" class="btn btn-success">Enroll Now</a>
                </div>
            </div>
        </div>

        <!-- Full Stack Developer Course -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-warning">
                <div class="card-header bg-warning text-white text-center">
                    <h4 class="card-title mb-0">Full Stack Development</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-3 text-muted">Frontend + Backend</h5>
                    <p class="card-text">
                        Become a full stack developer by mastering both frontend and backend technologies. This course combines HTML, CSS, JavaScript, React, PHP, Laravel, Node.js, and databases.
                    </p>
                    <ul>
                        <li>Frontend & UI Design</li>
                        <li>Backend API & Server Logic</li>
                        <li>Database Management</li>
                        <li>Project-Based Learning</li>
                        <li>Deployment & Cloud Hosting</li>
                    </ul>
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('add-student', ['course' => 'Fullstack']) }}" class="btn btn-warning text-white">Enroll Now</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection