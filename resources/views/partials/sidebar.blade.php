<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="#" onclick="return false">
        <span>{{ config('app.name') }}</span>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                @if(Auth::user()->is_admin)
                    <li class="{{ request()->is('delegates') ? 'active-page' : '' }}">
                        <a href="{{ route('delegates.index') }}">
                            <i class="menu-icon fa fa-car"></i><span>المندوبين</span>
                        </a>
                    </li>
                @endif
                <li class="{{ request()->is('trainees') ? 'active-page' : '' }}">
                    <a href="{{ route('trainees.index') }}">
                        <i class="menu-icon icon-people"></i><span>المتدربين</span>
                    </a>
                </li>
                <li class="menu-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="logout">
                            <i class="menu-icon fa fa-sign-out"></i><span>تسجيل الخروج</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div><!-- /Page Sidebar -->
