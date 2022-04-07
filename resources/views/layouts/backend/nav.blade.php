<!-- Header -->
<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="">
    <div class="mdk-header__content">
        <div class="navbar navbar-expand navbar-light navbar-light-dodger-blue navbar-shadow mdk-header--fixed" id="default-navbar" data-primary>
            <!-- Navbar toggler -->
            <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                <span class="material-icons">short_text</span>
            </button>

            <!-- Navbar Brand -->
            <a href="/" class="navbar-brand mr-16pt">
                <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                    <img src="{{ asset('images/nav-logo.png') }}" alt="logo" class="img-fluid" style="height: 100%; width: auto;"/>
                    <span class="h5">SendMail</span> 
                </span>
            </a>

            <div class="flex"></div>

            <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">

                <!-- Notifications dropdown -->
                <div class="nav-item dropdown dropdown-notifications dropdown-xs-down-full">
                    <button class="nav-link btn-flush dropdown-toggle" type="button" data-toggle="dropdown"
                        data-caret="false">
                        <i class="material-icons icon-24pt">mail_outline</i>
                    </button>
                </div>
                <!-- // END Notifications dropdown -->

                <!-- Account Menu -->
                <div class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
                        <span class="avatar avatar-sm mr-8pt2">
                            @if(!empty(auth()->user()->avatar))
                            <img src="{{ asset('/storage/avatars/' . auth()->user()->avatar) }}" alt="people" class="avatar-img rounded-circle">
                            @else
                            <span class="avatar-title rounded-circle">{{ substr(auth()->user()->first_name, 0, 2) }}</span>
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <strong>{{ auth()->user()->name }}</strong>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile') }}">My Account</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>