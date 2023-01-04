<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">
    <a class="brand-link" href="{{ route('frontend.index') }}">
        <img src="{{ asset(get_setting('admin_logo')) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('admin.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer" :active="activeClass(Route::is('admin.dashboard'))" class="nav-link" />
                </li>

                {{-- order --}}
                <li class="nav-item {{ activeClass(Route::is('admin.order.*'), 'menu-open') }}">
                    <x-utils.link-sidebar href="#" :text="__('Orders')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.order.*'))" />
                    <ul class="nav nav-treeview">
                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.order.recent')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Recent Orders')" />
                        </li>
                        @endif
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.order.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Manage Wallet')" />
                        </li>

                        {{-- <li class="nav-item">
              <x-utils.link :href="route('admin.order.local')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Local Product')" />
            </li> --}}
                    </ul>
                </li>
                {{-- product --}}
                {{-- <li class="nav-item {{ activeClass(Route::is('admin.product.*'), 'menu-open') }}">
                <x-utils.link-sidebar href="#" :text="__('Product')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.product.*'))" />
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Products Details')" />
                    </li>

                    <li class="nav-item menu-open">
                        <x-utils.link-sidebar href="#" :text="__('Product`s Settings')" icon="nav-icon icon-settings" class="nav nav-link" rightIcon="fas fa-angle-left right" />
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <x-utils.link :href="route('admin.product.status.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Status')" />
                            </li>

                            <li class="nav-item">
                                <x-utils.link :href="route('admin.product.warehouse.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Warehouse')" />
                            </li>

                            <li class="nav-item">
                                <x-utils.link :href="route('admin.product.shipping.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Shipping')" />
                            </li>

                        </ul>
                    </li>
                </ul>
                </li> --}}

                {{-- Accounts --}}
                @if ($logged_in_user->hasAllAccess())
                <li class="nav-item {{ activeClass(Route::is('admin.account.*'), 'menu-open') }}">
                    <x-utils.link-sidebar href="#" :text="__('Accounts')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.account.*'))" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.account.skybuy')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('SkyBuy Accounts')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.account.skyone')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('SkyOne Accounts')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Offline Customer Accounts')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Office Accounts')" />
                        </li>
                    </ul>
                </li>
                @endif

                {{-- Reports --}}
                @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('Reports')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Shipping Report')" />
                        </li>
                        {{-- <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Sale Report')" />
            </li> --}}
                    </ul>
                </li>
                @endif




                {{-- <li class="nav-item">
          <x-utils.link-sidebar :href="route('admin.page.index')" :text="__('Manage Page')" :active="activeClass(Route::is('admin.page.*'))" icon="nav-icon fas fa-file-word" class="nav-link" />
        </li>  --}}

                {{-- Messeging --}}
                {{-- <li class="nav-item {{ activeClass(Route::is('admin.messaging.*'), 'menu-open') }}">
                <x-utils.link-sidebar href="#" :text="__('Messaging')" icon="nav-icon icon-envelope" class="nav-link" rightIcon="fas fa-angle-left right" />
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <x-utils.link :href="route('admin.messaging.contact.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Contacts')" />
                    </li>
                    <li class="nav-item">
                        <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Newsletters')" />
                    </li>
                </ul>
                </li> --}}





                @if ($logged_in_user->hasAllAccess() ||
                ($logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')))
                <li class="nav-header">@lang('System')</li>
                <li class="nav-item {{ activeClass(Route::is('admin.auth.user.') || Route::is('admin.auth.role.'), 'menu-open') }}">
                    @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                <li class="nav-item">
                    <x-utils.link-sidebar href="#" :text="__('Settings')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <x-utils.link :href="route('frontend.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Home')" />
                        </li>

                        {{-- <li class="nav-item">
              <x-utils.link :href="route('admin.front-setting.topNotice.create')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Top Notice')" />
            </li> --}}
                        {{-- <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Pages')" />
            </li> --}}
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.general')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('General Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.price')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Price Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Products Category')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.notice')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Notice Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.info')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Information Settings')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.setting.page')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Page Settings')" />
                        </li>

                        {{-- <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Color Settings')" />
            </li> --}}
                    </ul>
                </li>
                @endif

                <x-utils.link-sidebar href="#" :text="__('Access')" icon="nav-icon flaticon-lock" class="nav-link" rightIcon="fas fa-angle-left right" />
                <ul class="nav nav-treeview">

                    @if ($logged_in_user->hasAllAccess() ||
                    ($logged_in_user->can('admin.access.user.list') ||
                    $logged_in_user->can('admin.access.user.deactivate') ||
                    $logged_in_user->can('admin.access.user.reactivate') ||
                    $logged_in_user->can('admin.access.user.clear-session') ||
                    $logged_in_user->can('admin.access.user.impersonate') ||
                    $logged_in_user->can('admin.access.user.change-password')))
                    <li class="nav-item">
                        <x-utils.link :href="route('admin.auth.user.index')" icon="nav-icon icon-user" class="nav-link" :text="__('User Management')" :active="activeClass(Route::is('admin.auth.user.*'))" />
                    </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                    <li class="nav-item">
                        <x-utils.link :href="route('admin.auth.role.index')" icon="nav-icon fas fa-user" class="nav-link" :text="__('Role Management')" :active="activeClass(Route::is('admin.auth.role.*'))" />
                    </li>
                    @endif
                </ul>
                </li>
                @endif

                @if ($logged_in_user->hasAllAccess())
                <li class="nav-item ">
                    <x-utils.link-sidebar href="#" :text="__('Logs')" icon="nav-icon fas fa-list" class="nav-link" rightIcon="fas fa-angle-left right" />
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-utils.link :href="route('log-viewer::dashboard')" icon="nav-icon far fa-circle" class="nav-link" :text="__('Dashboard')" />
                        </li>
                        <li class="nav-item">
                            <x-utils.link :href="route('log-viewer::logs.list')" icon="nav-icon far fa-circle" class="nav-link" :text="__('Logs')" />
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>