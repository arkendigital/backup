@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      @if(isset($category->name))
        <h2>{{ $category->name }}</h2>
      @endif

      {!! $page->getField("page_content") !!}

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    @include('partials.carousel-ticker')

    </div>

  </div><!-- /.website-container -->

  @if(count($categories) != 0)
    <div class="box-select" style="background-image:url(/images/temp/exams-select-bg.png);">
      <div class="box-select-container">

        <p class="box-select-title margin-top--x-large"></p>
        <p class="box-select-text"></p>

        @foreach($categories as $category)
          <a class="box-select-item" href="/exams/{{ $category->slug }}#exam-modules-container-anchor">{{ $category->name }}</a>
        @endforeach

        <div class="clear margin-bottom--x-large"></div>

      </div>
    </div><!-- /.box-select -->
  @else

    <div id="exam-modules-container-anchor" class="exam-modules-container" style="background-image:url(/images/temp/exams-select-bg.png);">
      <div class="exam-modules-inner">

        <div class="exam-modules-slider-wrap">
          <div class="exam-modules-slider swiper-container">
            <div class="swiper-wrapper">
              @foreach($category->getModules() as $key => $module)
                <div class="exam-modules-slider-item @if($key == 0) exam-modules-slider-item-active @endif swiper-slide" data-module-id="{{ $module->id }}">{{ $module->name }}</div>
              @endforeach
            </div>
          </div>

          <div class="exam-modules-slider-button exam-modules-slider-button-prev"><</div>
          <div class="exam-modules-slider-button exam-modules-slider-button-next">></div>
        </div>

        @foreach($category->getModules() as $key => $module)
          <div id="exam-modules-info-container-{{ $module->id }}" class="exam-modules-info-container" @if($key != 0) style="display: none;" @endif>
            <div class="exam-modules-info-header">
              <div class="exam-modules-info-header-name">{{ $module->name }}</div>
              <div class="exam-modules-info-header-content">
                <p class="exam-modules-info-header-content-title">{{ $module->name }} - {{ $module->info->name }}</p>
                <p class="exam-modules-info-header-content-excerpt">{{ $module->excerpt }}</p>
              </div>
            </div>

            <div>
              @foreach($module_sections as $module_section_key)
                @if($module->info->{'section_'.$module_section_key.'_title'} == "")
                  @continue
                @endif
                <div class="exam-modules-info-section">
                  <p class="exam-modules-info-section-title">{{ $module->info->{'section_'.$module_section_key.'_title'} }}</p>
                  @if($module->info->{'section_'.$module_section_key.'_link'} == "")
                    <p class="exam-modules-info-section-text">{{ $module->info->{'section_'.$module_section_key.'_text'} }}</p>
                  @else
                    <a class="exam-modules-info-section-button" href="{{ $module->info->{'section_'.$module_section_key.'_link'} }}" target="_blank">
                      {{ $module->info->{'section_'.$module_section_key.'_text'} }}
                    </a>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        @endforeach

      </div>
    </div><!-- /.exam_modules_container -->

  @endif

  @include("widgets.loop")

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

  @push("scripts-after")
    <script>
    $(function() {
      var swiper = new Swiper('.exam-modules-slider', {
        slidesPerView: 4,
        spaceBetween: 50,
        navigation: {
          nextEl: '.exam-modules-slider-button-next',
          prevEl: '.exam-modules-slider-button-prev',
        },
        breakpoints: {
            // when window width is <= 500px
            500: {
              slidesPerView: 1
            },
            // when window width is <= 650px
            650: {
              slidesPerView: 2
            },
            // when window width is <= 900px
            900: {
              slidesPerView: 3
            }
          }
      });
    });
    </script>
  @endpush

@endsection
