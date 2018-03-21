<div class="homepage-information">
  <div class="website-container">

    <img src="/images/icons/arrow-down--dark-blue.png" alt="Scroll Down" title="Scroll Down" class="homepage-information-arrow-down">

    <p class="homepage-information-title">A wealth of information</p>
    <p class="homepage-information-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius.</p>

    <div class="clear"></div>

    <div>
      <div class="homepage-information-box homepage-information-box-thinking">
        <div class="homepage-information-box-icon">
          <img src="/images/icons/homepage/thinking.png" alt="I'm thinking of becoming an Actuary" title="I'm thinking of becoming an Actuary">
        </div>
        <p class="homepage-information-box-title">I'm thinking of becoming an actuary</p>
        <p class="homepage-information-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum</p>
      </div>

      <div class="homepage-information-box homepage-information-box-studying">
        <div class="homepage-information-box-icon">
          <img src="/images/icons/homepage/studying.png" alt="I'm thinking of becoming an Actuary" title="I'm thinking of becoming an Actuary">
        </div>
        <p class="homepage-information-box-title">I'm studying to becoming an actuary</p>
        <p class="homepage-information-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum</p>
      </div>

      <div class="homepage-information-box homepage-information-box-iam">
        <div class="homepage-information-box-icon">
          <img src="/images/icons/homepage/iam.png" alt="I'm thinking of becoming an Actuary" title="I'm thinking of becoming an Actuary">
        </div>
        <p class="homepage-information-box-title">I am an actuary</p>
        <p class="homepage-information-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum</p>
      </div>
    </div>

    <div class="clear"></div>

    <div class="homepage-information-box-additional">
      <div class="homepage-information-box-additional-tabs">
        <a class="bg-orange">Topic one</a>
        <a class="bg-orange">Topic two</a>
        <a class="bg-orange">Topic three</a>
        <a class="bg-orange">Topic four</a>
      </div>

      <div class="homepage-information-box-additional-content">
        <p class="homepage-information-box-additional-content-title">Topic one</p>
        <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
      </div>
    </div>

    <div class="homepage-information-box-additional homepage-information-box-additional-hidden">
      <div class="homepage-information-box-additional-tabs">
        <a class="bg-orange">Topic one</a>
        <a class="bg-orange">Topic two</a>
        <a class="bg-orange">Topic three</a>
        <a class="bg-orange">Topic four</a>
      </div>

      <div class="homepage-information-box-additional-content">
        <p class="homepage-information-box-additional-content-title">Topic one</p>
        <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
      </div>
    </div>

    <div class="homepage-information-box-additional homepage-information-box-additional-hidden">
      <div class="homepage-information-box-additional-tabs">
        <a class="bg-orange">Topic one</a>
        <a class="bg-orange">Topic two</a>
        <a class="bg-orange">Topic three</a>
        <a class="bg-orange">Topic four</a>
      </div>

      <div class="homepage-information-box-additional-content">
        <p class="homepage-information-box-additional-content-title">Topic one</p>
        <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
      </div>
    </div>

    <div class="clear"></div>

    <p class="homepage-information-title margin-top--large">Join our discussions</p>
    <p class="homepage-information-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius.</p>

    <div class="homepage-discussion-slider swiper-container">
      <div class="swiper-wrapper">

        @foreach($discussions as $discussion)
          <div class="homepage-discussion-slider-box swiper-slide" style="background-image:url({{ $discussion->image }});">
            <div class="homepage-discussion-slider-box-hover">
              <a href="/discussion/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                <p class="homepage-discussion-slider-box-title">{{ $discussion->name }}</p>
                <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
              </a>
            </div>
          </div>
        @endforeach

      </div>
    </div>

    <img src="/images/icons/arrow-down--dark-blue.png" alt="Scroll Down" title="Scroll Down" class="homepage-information-arrow-down margin-top--large">

  </div><!-- /.website-container -->
</div><!-- /.homepage-information -->
