<!-- resources/views/partials/sidebar.blade.php -->
<div id="sidebar" class="sidebar d-flex flex-column flex-shrink-0 position-fixed vh-100">
    <div class="p-3 border-bottom d-flex justify-content-between">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none">
            <span class="fs-4">Welcome!</span>
        </a>

        <button class="btn btn-primary me-2" id="sidebar-toggle" aria-label="Toggle Sidebar" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div class="text-center p-3 hover-shadow position-relative">
        @if(Auth::check() && $user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="rounded-circle avatar-md hover-cursor">
        @else
            <i data-feather="user" class="rounded-circle avatar-md hover-cursor"></i>
        @endif
        <p class="mt-2">{{ Auth::check() ? $user->name : 'Guest' }}</p>


        
    </div>
    <div class="px-3 mb-3">
        <!-- Optional: add some menu or info -->
    </div>
    <ul class="nav nav-pills flex-column mb-auto px-2 mx-2">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}" role="tab">
                <i data-feather="grid" class="mr-2 d-none d-md-inline"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('add-student') }}" class="nav-link {{ request()->routeIs('add-student') ? 'active' : '' }}" role="tab">
                <i data-feather="plus" class="mr-2 d-none d-md-inline"></i>
                <span>Add New Student</span>
            </a>
        </li>
        <li>
            <a href="{{ route('manage-students') }}" class="nav-link {{ request()->routeIs('manage-students') ? 'active' : '' }}" role="tab">
                <i data-feather="list" class="mr-2 d-none d-md-inline"></i>
                <span>Manage Students</span>
            </a>
        </li>
        <li>
            <a href="{{ route('courses.all') }}" class="nav-link {{ request()->routeIs('courses.all') ? 'active' : '' }}" role="tab">
                <i data-feather="book" class="mr-2 d-none d-md-inline"></i>
                <span>Courses</span>
            </a>
        </li>
        <li>
            <a href="{{ route('opportunities') }}" class="nav-link {{ request()->routeIs('opportunities') ? 'active' : '' }}" role="tab">
                <i data-feather="briefcase" class="mr-2 d-none d-md-inline"></i>
                <span>Opportunities</span>
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" role="tab">
                <i data-feather="info" class="mr-2 d-none d-md-inline"></i>
                <span>About</span>
            </a>
        </li>
    </ul>
</div>