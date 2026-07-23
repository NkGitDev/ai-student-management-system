<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid mx-3">
        <button class="btn btn-primary me-2" id="sidebar-toggle" aria-label="Toggle Sidebar" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
       
        <div class="d-flex align-items-center">
             <!-- Theme toggle -->
            <button class="btn me-2" id="theme-toggle" aria-label="Toggle Theme">
                <i class="bi bi-sun-fill" id="theme-icon"></i>
            </button>
            
            <!-- User dropdown -->
            <div class="dropdown ms-auto">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::check() && $user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="rounded-circle me-2 nav-img">
                    @else
                        <i data-feather="user" class="nav-icon"></i>
                    @endif
                    <span>{{ Auth::check() ? $user->name : 'Guest' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if(Auth::check())
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('user-profile.edit', $user->id) }}">
                            <i data-feather="user" class="me-2"></i> My Account
                        </a>
                    </li>
                    <li>
                                               

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                    @else
                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>