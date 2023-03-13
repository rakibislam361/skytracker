<aside class="main-sidebar sidebar-light-cyan elevation-3">
    <div class="w-100 text-center py-3 border-bottom">
        <a href="{{ route('frontend.user.account') }}">
            <div class="rounded-circle d-inline-block adm-profile-container"><img src="/img/business.png" alt="image"
                    class="rounded-circle elevation-2" style="width:70px;height:70px;"></div>
        </a>
        <p class="text-center text-color-2 mt-2 mb-0 font-17 font-md-15 font-medium">
            {{ $logged_in_user->name ?? 'User' }} 
        </p>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    {{-- <x-utils.link-sidebar :href="route('frontend.user.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer"
                        :active="activeClass(Route::is('frontend.user.dashboard'))" class="nav-link" /> --}}
                    <a class="btn btn-lg btn-block" style="background-color: #6f42c1;"
                        href="{{ route('frontend.user.dashboard') }}">
                        <p style="color: white;margin-bottom: 0rem;">Dashboard</p>
                    </a>
                </li>

                <li>
                    {{-- <x-utils.link-sidebar href="#" :text="__('My Bookings')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.user.bookings')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Bookings')" />
                        </li>
                    </ul> --}}
                    <div class="w-100 text-center py-1">
                        <a href="{{ route('frontend.user.bookings') }}">
                            <div class="rounded-circle d-inline-block adm-profile-container"><img src="/img/booking.png"
                                    alt="image" style="width:35px;height:35px;">
                            </div>
                            <p>My Bookings</p>
                        </a>
                    </div>
                    {{-- <div style="align-content: center">
                        <img src="/img/booking.png" alt="image" style="width:35px;height:35px;">
                    </div> --}}
                </li>

                {{-- <li class="nav-item {{ activeClass(Route::is('admin.auth.user.') || Route::is('admin.auth.role.'), 'menu-open') }}"> --}}

                <li class="nav-item">
                    {{-- <x-utils.link-sidebar href="#" :text="__('My Invoices')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.user.invoices')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Invoices')" />
                        </li>

                    </ul> --}}
                    <div class="w-100 text-center py-1">
                        <a href="{{ route('frontend.user.invoices') }}">
                            <div class="rounded-circle d-inline-block adm-profile-container"><img src="/img/invoice.png"
                                    alt="image" style="width:35px;height:35px;">
                            </div>
                            <p>My Invoices</p>
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
