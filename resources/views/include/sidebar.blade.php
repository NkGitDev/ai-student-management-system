<!-- <div class="sidebar border-end bg-dark d-flex flex-column flex-shrink-0 p-3">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">My App</span>
    </a>
    <hr>
    <div class="user-box text-center mb-3">
        @if(Auth::check())
            @php $user = Auth::user(); @endphp
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}'s Image" class="rounded-circle avatar-md">
            @else
                <i data-feather="user" class="rounded-circle avatar-md"></i>
            @endif
            <p class="text-muted mt-2">{{ $user->name ?? 'Guest' }}</p>
        @else
            <i data-feather="user" class="rounded-circle avatar-md"></i>
            <p class="text-muted mt-2">Guest</p>
        @endif
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" role="tab">
                <i data-feather="grid" class="mr-2 d-none d-md-inline"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('add-student') }}" class="nav-link text-white {{ request()->routeIs('add-student') ? 'active' : '' }}" role="tab">
                <i data-feather="plus" class="mr-2 d-none d-md-inline"></i>
                <span>Add New Student</span>
            </a>
        </li>
        <li>
            <a href="{{ route('manage-students') }}" class="nav-link text-white {{ request()->routeIs('manage-students') ? 'active' : '' }}" role="tab">
                <i data-feather="list" class="mr-2 d-none d-md-inline"></i>
                <span>Manage Students</span>
            </a>
        </li>
        <li>
            <a href="{{ route('courses.all') }}" class="nav-link text-white {{ request()->routeIs('courses.all') ? 'active' : '' }}" role="tab">
                <i data-feather="book" class="mr-2 d-none d-md-inline"></i>
                <span>Courses</span>
            </a>
        </li>
        <li>
            <a href="{{ route('opportunities') }}" class="nav-link text-white {{ request()->routeIs('opportunities') ? 'active' : '' }}" role="tab">
                <i data-feather="briefcase" class="mr-2 d-none d-md-inline"></i>
                <span>Opportunities</span>
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}" class="nav-link text-white {{ request()->routeIs('about') ? 'active' : '' }}" role="tab">
                <i data-feather="info" class="mr-2 d-none d-md-inline"></i>
                <span>About</span>
            </a>
        </li>
    </ul>
</div> -->















    <nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="p-4">
            <h4 class="logo-text fw-bold mb-0">Welcome!</h4>
            <p class="text-muted small hide-on-collapse">Dashboard</p>
        </div>

        <div class="nav flex-column">
            <a href="#" class="sidebar-link active text-decoration-none p-3">
                <i class="fas fa-home me-3"></i>
                <span class="hide-on-collapse">Dashboard</span>
            </a>
            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-chart-bar me-3"></i>
                <span class="hide-on-collapse">Analytics</span>
            </a>
            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-users me-3"></i>
                <span class="hide-on-collapse">Customers</span>
            </a>

            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-box me-3"></i>
                <span class="hide-on-collapse">Products</span>
            </a>
            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-gear me-3"></i>
                <span class="hide-on-collapse">Settings</span>
            </a>
        </div>

        <div class="profile-section mt-auto p-4">
            <div class="d-flex align-items-center">
                <img src="https://randomuser.me/api/portraits/women/70.jpg" style="height:60px" class="rounded-circle" alt="Profile">
                <div class="ms-3 profile-info">
                    <h6 class="text-white mb-0">Alex Morgan</h6>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>
    </nav>

    
