<ul class="nav justify-content-center" id="profile-nav">
    <li class="nav-item">
        <a class="nav-link border-right {{ Request::segment(3) == null ? 'active' : '' }}" href="{{ route('web.profile.index') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link border-right {{ Request::segment(3) == 'employment' ? 'active' : '' }}" href="{{ route('web.profile.employment') }}">Employment</a>
    </li>
    <li class="nav-item">
        <a class="nav-link border-right {{ Request::segment(3) == 'changepassword' ? 'active' : '' }}" href="{{ route('web.profile.changepassword') }}">Change Password</a>
    </li>
    <li class="nav-item">
        <a class="nav-link border-right {{ Request::segment(3) == 'requests' ? 'active' : '' }}" href="{{ route('web.profile.requests') }}">Requests <span class="badge badge-danger">{{ Auth::user()->employee_info->leave_requests->count() }}</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">Team</a>
    </li>
</ul>
