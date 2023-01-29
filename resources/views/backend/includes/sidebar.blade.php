<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">
    <a class="brand-link" href="{{ route('frontend.index') }}">
        <img src="{{ asset(get_setting('admin_logo')) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <x-utils.link-sidebar :href="route('admin.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer"
                        :active="activeClass(Route::is('admin.dashboard'))" class="nav-link" />
                </li>

                {{-- order --}}
                @if (
                    $logged_in_user->hasAllAccess() ||
                        $logged_in_user->can('admin.order.order_rmb.edit') ||
                        $logged_in_user->can('admin.order.localdelivery.edit') ||
                        $logged_in_user->can('admin.order.purchase.edit') ||
                        $logged_in_user->can('admin.order.chn_warehouse_qty') ||
                        $logged_in_user->can('admin.order.chn_warehouse_weight') ||
                        $logged_in_user->can('admin.order.status.shipped-from-china-warehouse') ||
                        $logged_in_user->can('admin.order.status.received-in-BD-warehouse'))
                    <li class="nav-item {{ activeClass(Route::is('admin.order.*'), 'menu-open') }}">
                        <x-utils.link-sidebar href="#" :text="__('Orders')" icon="nav-icon icon-star"
                            class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.order.*'))" />
                        <ul class="nav nav-treeview">
                            @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                                <li class="nav-item">
                                    <x-utils.link :href="route('admin.order.recent')" icon="nav-icon icon-arrow-right" class="nav-link"
                                        :text="__('Recent Orders')" />
                                </li>
                            @endif
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.order.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                    :text="__('Manage Wallet')" />
                            </li>


                            {{-- <li class="nav-item">
              <x-utils.link :href="route('admin.order.local')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Local Product')" />
            </li> --}}
                        </ul>
                    </li>
                @endif
                {{-- Accounts --}}
                @if ($logged_in_user->can('admin.accounts'))
                    @unlessrole('Administrator')
                        <li class="nav-item {{ activeClass(Route::is('admin.account.*'), 'menu-open') }}">
                            <x-utils.link-sidebar href="#" :text="__('Accounts')" icon="nav-icon icon-star"
                                class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.account.*'))" />
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <x-utils.link :href="route('admin.account.skybuy')" icon="nav-icon icon-arrow-right" class="nav-link"
                                        :text="__('SkyBuy Accounts')" />
                                </li>
                                <li class="nav-item">
                                    <x-utils.link :href="route('admin.account.skyone')" icon="nav-icon icon-arrow-right" class="nav-link"
                                        :text="__('SkyOne Accounts')" />
                                </li>
                                <li class="nav-item">
                                    <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                        :text="__('Offline Customer Accounts')" />
                                </li>
                                <li class="nav-item">
                                    <x-utils.link :href="route('admin.product.product.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                        :text="__('Office Accounts')" />
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- Super Admin Accounts will write here --}}
                    @endunlessrole
                @endif

                {{-- Reports --}}
                @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                    <li class="nav-item">
                        <x-utils.link-sidebar href="#" :text="__('Reports')" icon="nav-icon icon-star"
                            class="nav-link" rightIcon="fas fa-angle-left right" />
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link"
                                    :text="__('Shipping Report')" />
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                    <li class="nav-item {{ activeClass(Route::is('admin.booking.*'), 'menu-open') }}">
                        <x-utils.link-sidebar href="#" :text="__('Local Booking')" icon="nav-icon icon-star"
                            class="nav-link" rightIcon="fas fa-angle-left right" />
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.booking.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                    :text="__('Booking Order')" />
                            </li>
                            <li class="nav-item">
                                <x-utils.link :href="route('admin.invoice.index')" icon="nav-icon icon-arrow-right" class="nav-link"
                                    :text="__('Invoice')" />
                            </li>
                        </ul>
                    </li>
                @endif

                @if (
                    $logged_in_user->hasAllAccess() ||
                        ($logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')))
                    <li class="nav-header">@lang('System')</li>
                    <li
                        class="nav-item {{ activeClass(Route::is('admin.auth.user.') || Route::is('admin.auth.role.'), 'menu-open') }}">
                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.setting'))
                    <li class="nav-item">
                        <x-utils.link-sidebar href="#" :text="__('Settings')" icon="nav-icon icon-star"
                            class="nav-link" rightIcon="fas fa-angle-left right" />
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
                @endif

                {{-- Access --}}
                <x-utils.link-sidebar href="#" :text="__('Access')" icon="nav-icon flaticon-lock" class="nav-link"
                    rightIcon="fas fa-angle-left right" />
                <ul class="nav nav-treeview">

                    @if (
                        $logged_in_user->hasAllAccess() ||
                            ($logged_in_user->can('admin.access.user.list') ||
                                $logged_in_user->can('admin.access.user.deactivate') ||
                                $logged_in_user->can('admin.access.user.reactivate') ||
                                $logged_in_user->can('admin.access.user.clear-session') ||
                                $logged_in_user->can('admin.access.user.impersonate') ||
                                $logged_in_user->can('admin.access.user.change-password')))
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.auth.user.index')" icon="nav-icon icon-user" class="nav-link"
                                :text="__('User Management')" :active="activeClass(Route::is('admin.auth.user.*'))" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="nav-item">
                            <x-utils.link :href="route('admin.auth.role.index')" icon="nav-icon fas fa-user" class="nav-link"
                                :text="__('Role Management')" :active="activeClass(Route::is('admin.auth.role.*'))" />
                        </li>
                    @endif
                </ul>
                </li>
                @endif

                @if ($logged_in_user->hasAllAccess())
                    <li class="nav-item ">
                        <x-utils.link-sidebar href="#" :text="__('Logs')" icon="nav-icon fas fa-list"
                            class="nav-link" rightIcon="fas fa-angle-left right" />
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
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
