<div class="card">
  <div class="card-header with-border">
    <h3 class="card-title">Manage Bottom Banner </h3>
  </div>
  <div class="card-body">

    {{ html()->form('POST', route('admin.setting.bottombanner.store'))->attribute('enctype', 'multipart/form-data')->open() }}

    <div class="form-group">
      {{html()->label('Header Color')->for('btbanner_color_1')}}
      {{html()->text('btbanner_color_1', get_setting('btbanner_color_1'))
      ->placeholder('btbanner_color_1')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Title Color')->for('btbanner_color_2')}}
      {{html()->text('btbanner_color_2', get_setting('btbanner_color_2'))
      ->placeholder('btbanner_color_2')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Text Color')->for('btbanner_color_3')}}
      {{html()->text('btbanner_color_3', get_setting('btbanner_color_3'))
      ->placeholder('btbanner_color_3')
      ->class('form-control')}}
    </div> <!-- form-group-->

    <div class="form-group">
      {{html()->label('Bottom Banner Header')->for('bottombanner_text_header')}}
      {{html()->text('bottombanner_text_header', get_setting('bottombanner_text_header'))
      ->placeholder('bottombanner_text_header')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Bottom Banner Bottom')->for('bottombanner_text_bottom')}}
      {{html()->text('bottombanner_text_bottom', get_setting('bottombanner_text_bottom'))
      ->placeholder('bottombanner_text_bottom')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Bottom Background Color')->for('bottom_bg_color')}}
      {{html()->text('bottom_bg_color', get_setting('bottom_bg_color'))
      ->placeholder('bottom_bg_color')
      ->class('form-control')}}
    </div> <!-- form-group-->
    <div class="form-group">
      {{html()->label('Bottom Video Link')->for('bottom_video_link')}}
      {{html()->text('bottom_video_link', get_setting('bottom_video_link'))
      ->placeholder('bottom_video_link')
      ->class('form-control')}}
    </div> <!-- form-group-->

    <div class="form-group">
      {{html()->label('Bottom Banner Image')->for('bottombanner_image')}}
      {{html()->file('bottombanner_image')->class('form-control-file image d-none')->id('bottombanner_image')->acceptImage()}}
      <div class="d-block">
        <label for="bottombanner_image">
          <img src="{{asset(get_setting('bottombanner_image',$demoImg))}}" class="border img-fluid rounded holder" alt="Image upload">
        </label>
      </div>
    </div> <!-- form-group-->
  
    <div class="form-group ">
      {{html()->button('Update')->class('btn btn-block  btn-primary')}}
    </div> <!-- form-group-->

    {{ html()->form()->close() }}

  </div> <!--  .card-body -->
</div> <!--  .card -->