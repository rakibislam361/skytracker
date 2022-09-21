<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;



Breadcrumbs::for(
  'admin.dashboard',
  fn (Trail $trail) =>
  $trail->push('Dashboard', 'admin.dashboard')
);

Breadcrumbs::for(
  'admin.product.inhouse.index',
  fn (Trail $trail) =>
  $trail->parent('admin.dashboard')->push('Products', 'admin.product.inhouse.index')
);

Breadcrumbs::for(
  'admin.product.inhouse.create',
  fn (Trail $trail) =>
  $trail->parent('admin.product.inhouse.index')->push('Create')
);
