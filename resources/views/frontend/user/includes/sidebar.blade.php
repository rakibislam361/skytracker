<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('frontend.user.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer"
                        :active="activeClass(Route::is('frontend.user.dashboard'))" class="nav-link" />
                </li>

                {{-- order --}}

                <li class="nav-item {{ activeClass(Route::is('admin.order.*'), 'menu-open') }}">
                    <x-utils.link-sidebar href="#" :text="__('Orders')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.order.*'))" />
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <x-utils.link :href="route('admin.order.recent')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Recent Orders')" />
                        </li>

                        <li class="nav-item">
                            <x-utils.link :href="route('admin.order.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Manage Wallet')" />
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('Reports')" icon="nav-icon icon-star" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link"
                                :text="__('Shipping Report')" />
                        </li>
                    </ul>
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

                <li class="nav-header">@lang('System')</li>
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

                        {{-- <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Color Settings')" />
            </li> --}}
                    </ul>
                </li>


                {{-- Access --}}
                <x-utils.link-sidebar href="#" :text="__('Access')" icon="nav-icon flaticon-lock" class="nav-link"
                    rightIcon="fas fa-angle-left right" />
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <x-utils.link :href="route('admin.auth.user.index')" icon="nav-icon icon-user" class="nav-link" :text="__('User Management')"
                            :active="activeClass(Route::is('admin.auth.user.*'))" />
                    </li>

                    <li class="nav-item">
                        <x-utils.link :href="route('admin.auth.role.index')" icon="nav-icon fas fa-user" class="nav-link" :text="__('Role Management')"
                            :active="activeClass(Route::is('admin.auth.role.*'))" />
                    </li>

                </ul>
                </li>



                <li class="nav-item ">
                    <x-utils.link-sidebar href="#" :text="__('Logs')" icon="nav-icon fas fa-list" class="nav-link"
                        rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('log-viewer::dashboard')" icon="nav-icon far fa-circle" class="nav-link"
                                :text="__('Dashboard')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('log-viewer::logs.list')" icon="nav-icon far fa-circle" class="nav-link"
                                :text="__('Logs')" />
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
