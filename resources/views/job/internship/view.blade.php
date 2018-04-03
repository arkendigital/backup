@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: #d62731;"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>Jobs</h1>
      <h2>Internships</h2>

    </div>
    <div class="website-container-sidebar">
      <div class="item-value">
        <p class="item-value--item">Location</p>
        <p class="item-value--value">London</p>
      </div>
      <div class="item-value">
        <p class="item-value--item">Opening date</p>
        <p class="item-value--value">10-5-2017</p>
      </div>
      <div class="item-value">
        <p class="item-value--item">Closing date</p>
        <p class="item-value--value">10-6-2017</p>
      </div>
      <div class="item-value">
        <p class="item-value--item">Duration</p>
        <p class="item-value--value">3 months</p>
      </div>
    </div>

    <div class="clear"></div>

    <div class="divider"></div>

    <div class="job-company-info">
      <img class="job-company-info-logo" src="/images/temp/jobs-company-logo.png" alt="" title="">
      <div class="job-company-info-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
        <div class="job-company-info-additional">
          <p>Address line One, Address Line Two</p>
          <p>email of company</p>
          <p>01234 456789</p>
        </div>
      </div>
    </div>

    <h2>Job description</h2>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>

    <p>Dugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>

    <p>Laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>

    <p>Dugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>

    <p>Laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

    <p><a href="" class="button button--orange">Apply</a></p>
    <p><a href="" class="button button--dark-blue">Back</a></p>

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion")

@endsection
