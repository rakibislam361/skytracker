@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Role'))

@section('content')

<div class="row justify-content-center">
  <div class="col-md-6">


    {{ html()->form('POST', route('admin.product.status.store'))->attribute('enctype', 'multipart/form-data')->open() }}
    <x-backend.card>
      <x-slot name="header">
        @lang('Create status')
      </x-slot>

      <x-slot name="headerActions">
        <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.product.status.index')" :text="__('Cancel')" />
      </x-slot>

      <x-slot name="body">



        <div class="form-group">
          {{html()->label('Status')->for('status')}}
          {{html()->text('status')
          ->class('form-control')
          ->placeholder('Status')
          ->required()}}
        </div> <!-- form-group -->

        <div class="form-group">
          {{html()->label('warehouse')->for('warehouse')}}
          {{html()->text('warehouse')
          ->class('form-control')
          ->placeholder('Warehouse')}}
        </div> <!-- form-group -->


      </x-slot>

      <x-slot name="footer">
        <button class="btn btn-sm btn-primary" type="submit">@lang('Create status')</button>
      </x-slot>
    </x-backend.card>

    {{ html()->form()->close() }}

  </div>
</div>




@endsection