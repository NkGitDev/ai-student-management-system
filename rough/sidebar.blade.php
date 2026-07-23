
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu bg-dark">
      <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">          
          @if(Auth::check())
                @php $user = Auth::user(); @endphp
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}'s Image" class="rounded-circle avatar-md">
                @else
                    <img src="{{ asset('assets/images/users/Guest-user.png') }}" alt="Default Avatar" class="rounded-circle avatar-md">
                @endif
                <p class="text-muted mt-2">{{ $user->name }}</p>
            @else
                <img src="{{ asset('assets/images/users/Guest-user.png') }}" alt="Default Avatar" class="rounded-circle avatar-md">
                <p class="text-muted mt-2">Guest</p>
          @endif
        </div>
        <!--- Sidemenu -->
        <div class="d-flex">
          <!-- Sidebar with vertical pills styling -->
          <div class="nav nav-pills flex-column" id="sidebar-pills" role="tablist">
            <!-- Dashboard -->
            <a href="{{ url('/') }}" class="nav-link text-white" role="tab">
              <i data-feather="grid" class="mr-2 d-none d-md-inline"></i>
              <span>Dashboard</span>
            </a>
            <!-- Add New Student -->
            <a href="{{ route('add-student') }}" wire:navigate class="nav-link text-white {{ request()->routeIs('add-student') ? 'active' : '' }}" role="tab">
              <i data-feather="plus" class="mr-2 d-none d-md-inline"></i>
              <span>Add New Student</span>
            </a>
            <!-- Manage Students -->
            <a href="{{ route('manage-students') }}" wire:navigate class="nav-link text-white {{ request()->routeIs('manage-students') ? 'active' : '' }}" role="tab">
              <i data-feather="list" class="mr-2 d-none d-md-inline"></i>
              <span>Manage Students</span>
            </a>
            <!-- Courses -->
            <a href="{{ route('courses.all') }}" wire:navigate class="nav-link text-white {{ request()->routeIs('courses.all') ? 'active' : '' }}" role="tab">
              <i data-feather="book" class="mr-2 d-none d-md-inline"></i>
              <span>Courses</span>
            </a>
            <!-- Opportunities -->
            <a href="{{ route('opportunities') }}" wire:navigate class="nav-link text-white {{ request()->routeIs('opportunities') ? 'active' : '' }}" role="tab">
              <i data-feather="briefcase" class="mr-2 d-none d-md-inline"></i>
              <span>Opportunities</span>
            </a>
            <!-- About -->
            <a href="{{ route('about') }}" wire:navigate class="nav-link text-white {{ request()->routeIs('about') ? 'active' : '' }}" role="tab">
              <i data-feather="info" class="mr-2 d-none d-md-inline"></i>
              <span>About</span>
            </a>
          </div>
        </div>
        
        <!-- End Sidebar -->
        <div class="clearfix"></div>
      </div>

  <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->


        
 