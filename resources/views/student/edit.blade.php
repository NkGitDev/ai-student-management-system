@extends('layouts/app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold text-uppercase"> Edit Student </h4>
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
                    <h4 class="header-title text-uppercase"> Basic Info</h4>
                    <hr>
                    <form class="needs-validation" novalidate="" method="POST" action="{{ route('update-student', $student->id) }}">
                        @csrf

                        <!-- user_id (optional, if needed) -->
                        <!--
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="validationCustomUserId">User ID</label>
                                    <input type="text" name="user_id" value="{{ $student->user_id }}" class="form-control border-bottom" id="validationCustomUserId" placeholder="Enter User ID" required>
                                </div>
                            </div>
                        </div>
                        -->

                        <!-- Full Name -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="validationCustomFullName">Full Name</label>
                                    <input type="text" name="full_name" value="{{ $student->full_name }}" class="form-control border-bottom" id="validationCustomFullName" placeholder="Enter Full Name" required>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="validationCustomMobile">Mobile Number</label>
                                    <input type="text" name="mobile_number" value="{{ $student->mobile_number }}" class="form-control border-bottom" id="validationCustomMobile" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="validationCustomAddress">Address</label>
                                    <input type="text" name="address" value="{{ $student->address }}" class="form-control border-bottom" id="validationCustomAddress" placeholder="Enter Address" required>
                                </div>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="validationCustomDob">Date of Birth</label>
                                    <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" class="form-control border-bottom" id="validationCustomDob" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('manage-students') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection