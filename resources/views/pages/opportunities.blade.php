@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Heading -->
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-success">Your Career Opportunity Awaits!</h1>
        <p class="lead text-muted">Join our courses and unlock your potential. Whether you want a job or freelance projects, we are here to help you succeed.</p>
    </div>

    <!-- Opportunity Highlights -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="card shadow-sm border-info p-4">
                <h3 class="text-info mb-3 text-center">What We Offer</h3>
                <ul class="list-group list-group-flush mb-3" style="font-size: 1.2rem;">
                    <li class="list-group-item"><strong>Job Placement Assistance:</strong> After completing our courses, we connect you with top startups and companies to land your dream job.</li>
                    <li class="list-group-item"><strong>Project Work & Freelancing:</strong> If you don't get a job immediately, don't worry! We provide real-world projects that you can work on to earn money and build your portfolio.</li>
                    <li class="list-group-item"><strong>Mentorship & Guidance:</strong> Our experts will guide you through career planning, resume building, and interview preparation.</li>
                    <li class="list-group-item"><strong>Continuous Support:</strong> Even after course completion, we keep supporting your career growth and freelance opportunities.</li>
                </ul>
                <div class="text-center">
                    <a href="#enroll" class="btn btn-success btn-lg">Join Now & Start Your Journey</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Motivational Message -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center shadow-sm border-primary p-4 rounded">
                <h4 class="mb-3">Your Success Is Our Goal!</h4>
                <p>Enroll in our courses today, learn in-demand skills, and take the first step towards a bright future. Remember, your career growth is just a click away.</p>
                <div class="text-center">
                    <a href="{{ route('add-student') }}" class="btn btn-primary d-inline btn-lg mt-3">Get Started Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection