{{-- @if(Auth::check() && Auth::user()->is_admin) --}}

<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="{{ route('dashboard') }}">
        <span>{{ config('app.name') }}</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="active-page">
                    <a href="{{ route('dashboard') }}">
                        <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cities.index') }}">
                        <i class="menu-icon icon-inbox"></i><span>City</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('delegates.index') }}">
                        <i class="menu-icon icon-inbox"></i><span>Delegate</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('trainees.index') }}">
                        <i class="menu-icon icon-inbox"></i><span>Trainee</span>
                    </a>
                </li>
                <li class="menu-divider"></li>
                {{-- <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form> --}}
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="menu-icon icon-inbox"></i><span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div><!-- /Page Sidebar -->

{{-- @endif --}}
