<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('frontend.user.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer"
                        :active="activeClass(Route::is('frontend.user.dashboard'))" class="nav-link" />
                </li>

                <li class="nav-item {{ activeClass(Route::is('admin.booking.*'), 'menu-open') }}">
                    <x-utils.link-sidebar href="#" :text="__('Booking')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.booking.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Booking Order')" />
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ activeClass(Route::is('admin.auth.user.') || Route::is('admin.auth.role.'), 'menu-open') }}">

                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('Settings')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Home')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.general')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('General Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.price')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Price Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Products Category')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.notice')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Notice Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.info')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Information Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.page')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Page Settings')" />
                        </li>


                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
