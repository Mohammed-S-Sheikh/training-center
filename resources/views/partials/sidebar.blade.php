<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="#" onclick="return false">
        <span>{{ config('app.name') }}</span>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
                    <li class="{{ request()->is('/') ? 'active-page' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="menu-icon fa fa-bar-chart"></i><span>الإدارة</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'admin')
                    <li class="{{ request()->is('users') ? 'active-page' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="menu-icon fa fa-car"></i><span>المستخدمين</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->country->name == 'ليبيا' || Auth::user()->role == 'admin')
                    <li class="{{ request()->is('trainees') ? 'active-page' : '' }}">
                        <a href="{{ route('trainees.index') }}">
                            <i class="menu-icon icon-people"></i><span>المتدربين</span>
                        </a>
                    </li>
                @endif

                {{-- @if(Auth::user()->country->name != 'ليبيا' || Auth::user()->role == 'admin')
                    <li class="{{ request()->is('foreign-trainees') ? 'active-page' : '' }}">
                        <a href="{{ route('foreign-trainees.index') }}">
                            <i class="menu-icon icon-people"></i><span>المتدربين الأجانب</span>
                        </a>
                    </li>
                @endif --}}

                @if(Auth::user()->role != 'driver')
                    <li class="{{ request()->is('leads') ? 'active-page' : '' }}">
                        <a href="{{ route('leads.index') }}">
                            <i class="menu-icon fa fa-square-o"></i><span>التنسيق</span>
                        </a>
                    </li>
                @endif

                <li class="menu-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="logout">
                            <i class="menu-icon fa fa-sign-out"></i>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div><!-- /Page Sidebar -->
