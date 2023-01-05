@extends('backend.layouts.app')

@section('title', ' General Settings ')

@php
$required = html()->span('*')->class('text-danger');
$demoImg = 'img/backend/front-logo.png';
@endphp

@section('content')

<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">
          General Settings
        </h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-5 col-sm-4">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">General Settings</a>
              <a class="nav-link" id="vert-tabs-api-tab" data-toggle="pill" href="#vert-tabs-api" role="tab" aria-controls="vert-tabs-api" aria-selected="true">Api Settings</a>
              <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Logo Settings</a>
              <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Social Settings</a>
              <a class="nav-link" id="vert-tabs-shortMessageSetting-tab" data-toggle="pill" href="#vert-tabs-shortMessageSetting" role="tab" aria-controls="vert-tabs-shortMessageSetting" aria-selected="false">Short Message Setting</a>
              <a class="nav-link" id="vert-tabs-smsConfigSetting-tab" data-toggle="pill" href="#vert-tabs-smsConfigSetting" role="tab" aria-controls="vert-tabs-smsConfigSetting" aria-selected="false">SMS Configuration Setting</a>
              <a class="nav-link" id="vert-tabs-invoiceSettings-tab" data-toggle="pill" href="#vert-tabs-invoiceSettings" role="tab" aria-controls="vert-tabs-invoiceSettings" aria-selected="false">Invoices Setting</a>
              <a class="nav-link" id="vert-tabs-otcConfigSetting-tab" data-toggle="pill" href="#vert-tabs-otcConfigSetting" role="tab" aria-controls="vert-tabs-otcConfigSetting" aria-selected="false">OTC Configuration Setting</a>
              <a class="nav-link" id="vert-tabs-bannerSetting-tab" data-toggle="pill" href="#vert-tabs-bannerSetting" role="tab" aria-controls="vert-tabs-bannerSetting" aria-selected="false">Banner Setting</a>
              <a class="nav-link" id="vert-tabs-noticeSetting-tab" data-toggle="pill" href="#vert-tabs-noticeSetting" role="tab" aria-controls="vert-tabs-noticeSetting" aria-selected="false">NoticeSetting Setting</a>
              <a class="nav-link" id="vert-tabs-aboutSetting-tab" data-toggle="pill" href="#vert-tabs-aboutSetting" role="tab" aria-controls="vert-tabs-aboutSetting" aria-selected="false">About Setting</a>
              <a class="nav-link" id="vert-tabs-workSetting-tab" data-toggle="pill" href="#vert-tabs-workSetting" role="tab" aria-controls="vert-tabs-workSetting" aria-selected="false">How Works Setting</a>
              <a class="nav-link" id="vert-tabs-bottombannerSetting-tab" data-toggle="pill" href="#vert-tabs-bottombannerSetting" role="tab" aria-controls="vert-tabs-bottombannerSetting" aria-selected="false">Bottom Banner Setting</a>
              
            </div>
          </div>
          <div class="col-7 col-sm-8">
            <div class="tab-content" id="vert-tabs-tabContent">
              <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                @include("backend.content.settings.general.includes.siteSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-api" role="tabpanel" aria-labelledby="vert-tabs-api-tab">
                @include("backend.content.settings.general.includes.apiSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                @include("backend.content.settings.general.includes.logoSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                @include("backend.content.settings.general.includes.social")
              </div>
              <div class="tab-pane fade" id="vert-tabs-shortMessageSetting" role="tabpanel" aria-labelledby="vert-tabs-shortMessageSetting-tab">
                @include("backend.content.settings.general.includes.shortMessageSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-smsConfigSetting" role="tabpanel" aria-labelledby="vert-tabs-smsConfigSetting-tab">
                @include("backend.content.settings.general.includes.smsConfigSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-invoiceSettings" role="tabpanel" aria-labelledby="vert-tabs-invoiceSettings-tab">
                @include("backend.content.settings.general.includes.invoiceSettings")
              </div>
              <div class="tab-pane fade" id="vert-tabs-otcConfigSetting" role="tabpanel" aria-labelledby="vert-tabs-otcConfigSetting-tab">
                @include("backend.content.settings.general.includes.otcConfigSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-bannerSetting" role="tabpanel" aria-labelledby="vert-tabs-bannerSetting-tab">
                @include("backend.content.settings.general.includes.bannerSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-aboutSetting" role="tabpanel" aria-labelledby="vert-tabs-aboutSetting-tab">
                @include("backend.content.settings.general.includes.aboutSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-workSetting" role="tabpanel" aria-labelledby="vert-tabs-workSetting-tab">
                @include("backend.content.settings.general.includes.workSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-bottombannerSetting" role="tabpanel" aria-labelledby="vert-tabs-bottombannerSetting-tab">
                @include("backend.content.settings.general.includes.bottombannerSetting")
              </div>
              <div class="tab-pane fade" id="vert-tabs-noticeSetting" role="tabpanel" aria-labelledby="vert-tabs-noticeSetting-tab">
                @include("backend.content.settings.general.includes.noticeSetting")
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div> <!-- col -->


</div> <!-- .row -->

@endsection




@push('after-scripts')
{!! script(asset('assets/plugins/tinymce/jquery.tinymce.min.js')) !!}
{!! script(asset('assets/plugins/tinymce/tinymce.min.js')) !!}
{!! script(asset('assets/plugins/tinymce/editor-helper.js')) !!}
<script>
  function readImageURL(input, preview) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        preview.attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $(document).ready(function() {
    small_editor('#invoice_site_address', 200);

    $(".image").change(function() {
      holder = $(this).closest('.form-group').find('.holder');
      readImageURL(this, holder);
    });
  });
</script>

@endpush