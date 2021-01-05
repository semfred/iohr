
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
{{--
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/web">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IOHR V1</div>
      </a>  --}}

      <hr class="sidebar-divider d-md-block">

      <div class="text-center d-none d-md-inline text-white" style="margin-bottom: 1rem;">
        <img src="https://via.placeholder.com/120" alt="" class="rounded-circle img-thumbnail">
      </div>

      <div class="text-center d-none d-md-inline text-white" style="margin-bottom: 1rem;">
          <p style="margin:0;padding:0 7px;">{{ \Auth::user()->employee_info->name }}</p>
          <small style="padding:0 7px;">
              <em>{{ isset(\Auth::user()->employee_info->employment->position) ? \Auth::user()->employee_info->employment->position->name : '' }}</em>
          </small>
      </div>

      <div class="text-center d-none d-md-inline text-white" style="margin-bottom: 1rem;">
        <div class="row">
            <div class="col border-right">
                <p>{{ \Auth::user()->employee_info->entitlement->vacation }}</p>
                <p><small>Vacation</small></p>
            </div>
            <div class="col">
                <p>{{ \Auth::user()->employee_info->entitlement->sick }}</p>
                <p><small>Sick</small></p>
            </div>
        </div>
      </div>

      <div class="text-center d-none d-md-inline" style="padding: 0 1rem; margin-bottom: 1rem;">
        {{-- <button class="rounded-circle border-0" id="sidebarToggle"></button> --}}
        <a href="{{ route('web.requests.create') }}" class="btn btn-block btn-outline-light">Create Request</a>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ (\Request::route()->getName() == 'web.dashboard.index') ? 'active' : '' }}">
        <a class="nav-link" href="/web">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Profile -->
      <li class="nav-item {{ (Request::segment(2) == 'profile') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('web.profile.index') }}">
          <i class="fas fa-fw fa-id-card"></i>
          <span>Profile</span></a>
      </li>

        @if(\Auth::user()->isAdmin() || \Auth::user()->superuser)

        <div class="sidebar-heading">
            Admin
        </div>
        <li class="nav-item {{ (Request::segment(2) == 'employees') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('web.employees.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Employees</span></a>
        </li>

        <li class="nav-item {{ (Request::segment(2) == 'users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('web.users.index') }}">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Users</span></a>
        </li>

        <li class="nav-item {{ (Request::segment(2) == 'requests') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('web.requests.index') }}">
                <i class="fas fa-fw fa-copy"></i>
                <span>Requests</span> <span style="" class="float-right badge badge-light">{{ \App\Leave::where('status', 'PENDING')->count() }}</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#settingsColapse" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
            <div id="settingsColapse" class="collapse {{ (Request::segment(2) == 'settings') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Content Settings:</h6>

                    <a class="collapse-item {{ (Request::segment(3) == 'positions') ? 'active' : '' }}" href="{{ route('web.positions.index') }}">Positions</a>

                    <a class="collapse-item {{ (Request::segment(3) == 'holidays') ? 'active' : '' }}" href="{{ route('web.settings.holidays.index') }}">Holidays</a>

                    {{-- <a class="collapse-item {{ (Request::segment(3) == 'clients') ? 'active' : '' }}" href="{{ route('web.clients.index') }}">Clients</a> --}}

                    {{-- <a class="collapse-item {{ (Request::segment(3) == 'teams') ? 'active' : '' }}" href="{{ route('web.teams.index') }}">Teams</a> --}}
                </div>
            </div>
        </li>

        @endif
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      {{--  <div class="text-center d-none d-md-inline">
        <a href="{{ route('web.requests.create') }}" class="btn btn-sm btn-success">Create Request</a>
      </div>  --}}
      {{--  <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>  --}}

    </ul>
    <!-- End of Sidebar -->
