<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Manage Banner </h3>
  </div>
  <div class="card-body">

    {{ html()->form('POST', route('admin.setting.banner.store'))->attribute('enctype', 'multipart/form-data')->open() }}

    <div class="form-group">
      {{html()->label('Header Color')->for('banner_color_1')}}
      {{html()->text('banner_color_1', get_setting('banner_color_1'))
      ->placeholder('banner_color_1')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Text Color')->for('banner_color_2')}}
      {{html()->text('banner_color_2', get_setting('banner_color_2'))
      ->placeholder('banner_color_2')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Search Color')->for('banner_color_3')}}
      {{html()->text('banner_color_3', get_setting('banner_color_3'))
      ->placeholder('banner_color_3')
      ->class('form-control')}}
    </div> <!-- form-group-->

    <div class="form-group">
      {{html()->label('Banner Header')->for('banner_text_header')}}
      {{html()->text('banner_text_header', get_setting('banner_text_header'))
      ->placeholder('banner_text_header')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Banner Bottom')->for('banner_text_bottom')}}
      {{html()->text('banner_text_bottom', get_setting('banner_text_bottom'))
      ->placeholder('banner_text_bottom')
      ->class('form-control')}}
    </div> <!-- form-group-->

    <div class="form-group">
      {{html()->label('Banner   Image')->for('banner_image')}}
      {{html()->file('banner_image')->class('form-control-file image d-none')->id('banner_image')->acceptImage()}}
      <div class="d-block">
        <label for="banner_image">
          <img src="{{asset(get_setting('banner_image',$demoImg))}}" class="border img-fluid rounded holder" alt="Image upload">
        </label>
      </div>
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Banner Background  Image')->for('banner_image_back')}}
      {{html()->file('banner_image_back')->class('form-control-file image d-none')->id('banner_image_back')->acceptImage()}}
      <div class="d-block">
        <label for="banner_image_back">
          <img src="{{asset(get_setting('banner_image_back',$demoImg))}}" class="border img-fluid rounded holder" alt="Image upload">
        </label>
      </div>
    </div> <!-- form-group-->
   
    <div class="form-group ">
      {{html()->button('Update')->class('btn btn-block  btn-primary')}}
    </div> <!-- form-group-->

    {{ html()->form()->close() }}

  </div> <!--  .card-body -->
</div> <!--  .card -->