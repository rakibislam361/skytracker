<section>
  <div class="theme-container container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 track-prod clrbg-before wow slideInUp" data-wow-offset="50" data-wow-delay=".20s">
        <h2 class="title-1"> track your product </h2> <span class="font2-light fs-12">Now you can
          track your product easily</span>
        <div class="row">
          <form class="trackproduct" action="{{ route('frontend.pages.tracking') }}" method="GET">
            <div class="col-md-7 col-sm-7">
              <div class="form-group">
                <input id="trackid" type="search" placeholder="Enter your invoice ID" required="" class="form-control box-shadow" name="trackid">
              </div>
            </div>
            <div class="col-md-5 col-sm-5">
              <div class="form-group">
                <button class="btn-1">Track your product</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</section>