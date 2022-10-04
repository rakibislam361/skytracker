<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-cyan elevation-3">
  <!-- Brand Logo -->
  <a href="{{route('admin.dashboard')}}" class="brand-link">
    <img src="{{asset('img/essential/admin.png')}}" alt="{{appName()}}" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{appName()}}</span>
  </a>

  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <x-utils.link-sidebar :href="route('admin.dashboard')" :text="__('Dashboard')" icon="nav-icon icon-speedometer" :active="activeClass(Route::is('admin.dashboard'), 'menu-open')" class="nav-link" />
        </li>

        <li class="nav-item {{ activeClass(Route::is('admin.product.*'), 'menu-open') }}">
          <x-utils.link-sidebar href="#" :text="__('Products')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" :active="activeClass(Route::is('admin.product.*'))" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="route('admin.product.brand.index')" icon="nav-icon icon-arrow-right" :active="activeClass(Route::is('admin.product.brand.*'))" class="nav-link" :text="__('Brand')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Category')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Subcategory')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Sub Subcategory')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="route('admin.product.inhouse.index')" icon="nav-icon icon-arrow-right" class="nav-link" :active="activeClass(Route::is('admin.product.inhouse.*'))" :text="__('In House Products')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Seller Products')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Bulk Import')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Bulk Export')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Product Reviews')" />
            </li>
          </ul>
        </li>

        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Orders')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Inhouse Orders')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Coupon Logs')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Coupons')" />
            </li>
          </ul>
        </li> -->

        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Total Sales')" icon="nav-icon fas fa-coins" class="nav-link" />
        </li> -->
        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Customers')" icon="nav-icon icon-users" class="nav-link" />
        </li> -->
        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Conversations')" icon="nav-icon fas fa-comments" class="nav-link" />
        </li> -->

        <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Reports')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Stock Report')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Sale Report')" />
            </li>
          </ul>
        </li>


        <!-- <li class="nav-item">
          <x-utils.link-sidebar :href="route('admin.page.index')" :text="__('Manage Page')" :active="activeClass(Route::is('admin.page.*'))" icon="nav-icon fas fa-file-word" class="nav-link" />
        </li> -->

        <li class="nav-item {{ activeClass(Route::is('admin.messaging.*'), 'menu-open') }}">
          <x-utils.link-sidebar href="#" :text="__('Messaging')" icon="nav-icon icon-envelope" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="route('admin.messaging.contact.index')" :active="activeClass(Route::is('admin.messaging.contact.*'))" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Cotacts')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Newsletters')" />
            </li>
          </ul>
        </li>

        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Business Settings')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Activation')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Payment Methods')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('SMTP Settings')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Google Analytics')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Facebook Chat & Pixel')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Social Login')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Currency')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Languages')" />
            </li>
          </ul>
        </li> -->

        <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('Frontend Settings')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Home')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Pages')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('General Settings')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Logo Settings')" />
            </li>
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Color Settings')" />
            </li>
          </ul>
        </li>

        <!-- <li class="nav-item">
          <x-utils.link-sidebar href="#" :text="__('E-commerce Setup')" icon="nav-icon icon-star" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <x-utils.link :href="url('#')" icon="nav-icon icon-arrow-right" class="nav-link" :text="__('Attribute')" />
            </li>
          </ul>
        </li> -->


        @if (
        $logged_in_user->hasAllAccess() ||
        (
        $logged_in_user->can('admin.access.user.list') ||
        $logged_in_user->can('admin.access.user.deactivate') ||
        $logged_in_user->can('admin.access.user.reactivate') ||
        $logged_in_user->can('admin.access.user.clear-session') ||
        $logged_in_user->can('admin.access.user.impersonate') ||
        $logged_in_user->can('admin.access.user.change-password')
        )
        )
        <li class="nav-header">@lang('System')</li>
        <li class="nav-item {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'menu-open') }}">
          <x-utils.link-sidebar href="#" :text="__('Access')" icon="nav-icon flaticon-lock" class="nav-link" rightIcon="fas fa-angle-left right" />
          <ul class="nav nav-treeview">

            @if (
            $logged_in_user->hasAllAccess() ||
            (
            $logged_in_user->can('admin.access.user.list') ||
            $logged_in_user->can('admin.access.user.deactivate') ||
            $logged_in_user->can('admin.access.user.reactivate') ||
            $logged_in_user->can('admin.access.user.clear-session') ||
            $logged_in_user->can('admin.access.user.impersonate') ||
            $logged_in_user->can('admin.access.user.change-password')
            )
            )
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