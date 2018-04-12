<div class="homepage-information">
  <div class="website-container">

    <img src="/images/icons/arrow-down--dark-blue.png" alt="Scroll Down" title="Scroll Down" class="homepage-information-arrow-down">

    <p class="homepage-information-title">A wealth of information</p>
    <p class="homepage-information-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius.</p>

    <div class="clear"></div>

    <div>
      @foreach ($wealth_of_information as $item)
        <div class="homepage-information-box homepage-information-box-{{ $item->slug }}" data-box="{{ $item->slug }}">
          <div class="homepage-information-box-icon">
            <img src="{{ $item->icon_path }}" alt="{{ $item->title }}">
          </div>
          <p class="homepage-information-box-title">I'm thinking of becoming an actuary</p>
          <p class="homepage-information-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum</p>
        </div>
      @endforeach
    </div>

    <div class="clear"></div>

    @foreach ($wealth_of_information as $item)
      @if ($item->data)
        <div class="homepage-information-box-additional  @if(! $loop->first) homepage-information-box-additional-hidden @endif"  id="{{ $item->slug }}">
          <div class="homepage-information-box-additional-tabs">
            @foreach ($item->data as $data)
              <a href="#" data-content="{{ strtolower(str_replace(' ', '_', $data->title)) }}" class="bg-{{ $item->colour }}">{{ $data->button_text }}</a>
            @endforeach        
          </div>

          <div class="homepage-information-box-additional-content {{ $item->slug }}-content"> 
            @foreach ($item->data as $data)
              <div id="{{ strtolower(str_replace(' ', '_', $data->title)) }}" @if(! $loop->first) style="display: none" @endif>
                <h5 class="homepage-information-box-additional-content-title">{{ $data->title }}</h5>
                {!! $data->content !!}
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endforeach

  

    {{-- <div class="homepage-information-box-additional homepage-information-box-additional-hidden" id="studying">
      <div class="homepage-information-box-additional-tabs">
        <a href="#" data-content="studying_topic_one" class="bg-orange">Topic one</a>
        <a href="#" data-content="studying_topic_two" class="bg-orange">Topic two</a>
        <a href="#" data-content="studying_topic_three" class="bg-orange">Topic three</a>
        <a href="#" data-content="studying_topic_four" class="bg-orange">Topic four</a>
      </div>

      <div class="homepage-information-box-additional-content studying-content">
        <div id="studying_topic_one">      
          <p class="homepage-information-box-additional-content-title">Studying</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="studying_topic_two" style="display: none">      
          <p class="homepage-information-box-additional-content-title">Studying</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="studying_topic_three" style="display: none">      
          <p class="homepage-information-box-additional-content-title">Studying</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="studying_topic_four" style="display: none">      
          <p class="homepage-information-box-additional-content-title">Studying</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>
      </div>
    </div>

    <div class="homepage-information-box-additional homepage-information-box-additional-hidden" id="iam">
      <div class="homepage-information-box-additional-tabs">
        <a href="#" data-content="iam_topic_one" class="bg-orange">Topic one</a>
        <a href="#" data-content="iam_topic_two" class="bg-orange">Topic two</a>
        <a href="#" data-content="iam_topic_three" class="bg-orange">Topic three</a>
        <a href="#" data-content="iam_topic_four" class="bg-orange">Topic four</a>
      </div>

      <div class="homepage-information-box-additional-content iam-content">
        <div id="iam_topic_one">
          <p class="homepage-information-box-additional-content-title">IAM</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="iam_topic_two" style="display: none;">
          <p class="homepage-information-box-additional-content-title">IAM 2</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="iam_topic_three" style="display: none;">
          <p class="homepage-information-box-additional-content-title">IAM 3</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>

        <div id="iam_topic_four" style="display: none;">
          <p class="homepage-information-box-additional-content-title">IAM 4</p>
          <p class="homepage-information-box-additional-content-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius. Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut intfacea am inciuscius.</p>
        </div>
      </div> --}}
    {{-- </div> --}}

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


@push('scripts-after')
  <script>
    $('.homepage-information-box').click(function() {
      var box = $(this).data('box');
      $('.homepage-information-box-additional').addClass('homepage-information-box-additional-hidden');
      $('#' + box).removeClass('homepage-information-box-additional-hidden');

      $('.homepage-information-box-additional-content > div').hide();      
      $('.' + box + '-content > div').first().show();
    });

    $('.homepage-information-box-additional-tabs a').click(function(e) {
      e.preventDefault();

      var box = $(this).data('content');
      $('.homepage-information-box-additional-content > div').hide();
      $('#' + box).show();
    });
  </script>

@endpush