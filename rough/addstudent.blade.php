@extends('layouts/app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold text-uppercase">Add Student</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Start Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('include/alert')
                    <h4 class="header-title text-uppercase">Basic Info</h4>
                    <hr>
                    <form class="needs-validation" novalidate="" method="post" action="{{ route('create-student') }}">
                        @csrf
                        <!-- user_id agar hidden ho sakta hai, ya dropdown me rakh sakte hain -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control border-bottom" id="full_name" placeholder="Enter full name" value="{{ old('full_name') }}" required>
                                </div>
                            </div>
                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control border-bottom" id="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Address -->
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control border-bottom" id="address" placeholder="Enter address" value="{{ old('address') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Date of Birth -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control border-bottom" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                </div>
                            </div>
                            <!-- Enrollment Number -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="enrollment_number">Enrollment Number</label>
                                    <input type="text" name="enrollment_number" class="form-control border-bottom" id="enrollment_number" placeholder="Enter enrollment number" value="{{ old('enrollment_number') }}" required>
                                </div>
                            </div>
                            <!-- Course -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="course">Course</label>
                                    <input type="text" name="course" class="form-control border-bottom" id="course" placeholder="Enter course" value="{{ old('course') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Admission Date -->
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="admission_date">Admission Date</label>
                                    <input type="date" name="admission_date" class="form-control border-bottom" id="admission_date" value="{{ old('admission_date') }}" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection