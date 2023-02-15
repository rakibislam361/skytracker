<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">
    <a class="brand-link" href="{{ route('frontend.index') }}">
        <img src="{{ asset(get_setting('frontend_logo_menu')) }}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('frontend.user.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer"
                        :active="activeClass(Route::is('frontend.user.dashboard'))" class="nav-link" />
                </li>

                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('My Bookings')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.user.bookings')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Bookings')" />
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item {{ activeClass(Route::is('admin.auth.user.') || Route::is('admin.auth.role.'), 'menu-open') }}"> --}}

                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('My Invoices')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.user.invoices')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Invoices')" />
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
