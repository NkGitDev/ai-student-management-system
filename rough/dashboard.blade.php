@extends('layouts.app')

@section('content')
@include('include/alert')

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                @if(Auth::check())
                <h1 class="text-info">Welcome, {{ $user->name ?? 'New User' }}!</h1>
                @endif
                <h4 class="page-title font-weight-bold">DASHBOARD</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Developers Section -->
    <div class="row mt-4">
        <!-- Web App Developers -->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="mdi mdi-web font-28 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                <span data-plugin="counterup">{{ $webAppDevelopers ?? 0 }}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Web App Developers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Android Developers -->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="mdi mdi-android font-28 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                <span data-plugin="counterup">{{ $androidDevelopers ?? 0 }}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Android Developers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backend Developers -->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="mdi mdi-server-network font-28 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                <span data-plugin="counterup">{{ $backendDevelopers ?? 0 }}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Backend Developers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fullstack Developers -->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="mdi mdi-layers font-28 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1">
                                <span data-plugin="counterup">{{ $fullstackDevelopers ?? 0 }}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Fullstack Developers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$user)
    <div class="text-center mt-4">
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-info rounded-lg" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="$('#loginModal').modal('show')">Please Login....</button>
    </div>
    @endif
</div>

@include('include/login-popup')
@include('include/register-popup')

@endsection