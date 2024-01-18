<!-- Header Starts -->
@auth
<header class="navbar navbar-expand-md sticky navbar-dark header-bg" style="background:#000000!important;">
    <a class="navbar-brand" href="#"></a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <!-- Home and Logout Buttons for Authenticated Users -->
            <li class="nav-item dropdown px-2">
                <a id="header-username-label" class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-toggle="dropdown">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <!-- User Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="{{ url('/home') }}" class="dropdown-item">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Home and Logout Buttons End -->
        </ul>
    </div>
</header>
@endauth

@guest
<header class="navbar navbar-expand-md sticky transparent-header">
    <a class a="navbar-brand" href="#"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item px-2">
                <a href="{{ url('') }}" class="nav-link">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item px-2">
                <a href="{{ route('login') }}" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i> Log in
                </a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item px-2">
                <a href="{{ route('register') }}" class="nav-link">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </li>
            @endif
        </ul>
    </div>
</header>
@endguest