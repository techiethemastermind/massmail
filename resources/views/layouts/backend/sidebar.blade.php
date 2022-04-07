<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <a href="#" class="sidebar-brand ">
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <img src="{{ asset('images/side-logo.png') }}" alt="logo" class="img-fluid" />
                </span>
            </a>

            <!-- Sidebar Head -->
            <div class="sidebar-heading">Dashboard</div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Subscribers -->
                <li class="sidebar-menu-item {{ Request::is('subscriber') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('subscriber') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">alternate_email</span>
                        <span class="sidebar-menu-text">Subscribers</span>
                    </a>
                </li>

                <!-- Other menus here -->
            </ul>

            <!-- Setting Header -->
            <div class="sidebar-heading">Setting</div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">

                <!-- Email Template -->
                <li class="sidebar-menu-item {{ Request::is('mailedits') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('mailedits.index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">mail_outline</span>
                        <span class="sidebar-menu-text">Email Template</span>
                    </a>
                </li>

                <!-- Profile -->
                <li class="sidebar-menu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('profile') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">face</span>
                        <span class="sidebar-menu-text">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- // END drawer -->

@push('after-scripts')
<script>
    $(document).ready(function(){

        // Make parent menu active
        var active_menus = $('li.sidebar-menu-item.active');
        $.each(active_menus, function(idx, item){
            $(this).closest('ul.sidebar-submenu').parent().addClass('active open');
        });
    });
</script>
@endpush