@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container" style="margin-bottom: 0;">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    </div>
  </div>

  <div class="website-container">
      @include('partials.carousel-ticker')
  </div>

  <div class="website-container">
    <div class="society-map-container">

      <p class="society-map-title">Find your Centre</p>

      <div class="society-map-search-wrap">
        <form action="" method="POST" id="societies_search">
          {{ csrf_field() }}
          {{ method_field("POST") }}

          <input class="society-map-search-input" type="text" name="search" placeholder="Enter your search...">
        </form>
        <p class="society-map-search-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inci uscius. Con comnis alictatus</p>
      </div>

      <div class="society-map" id="map"></div>

      <div class="society-map-list"></div>

    </div><!-- /.society-map-container -->


    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      <a href="{{ $page_adverts[0]["main-content"]["url"] }}" target="_blank" class="advert-box">
        <img src="{{ $page_adverts[0]["main-content"]["image"] }}" alt="" title="">
      </a>
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

  @push("scripts-after")
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHVFTM_LS8YLRx8fog61RzDT054G4C8jY" async defer></script>
    <script>
    $("#societies_search").submit(function(e) {

      e.preventDefault;

      /**
      * Remove any old societies from list.
      *
      */
      $(".society-map-list").html("");

      /**
      * Shoot the search to the controller and handle the results.
      *
      */
      $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: new FormData( this ),
        processData: false,
        contentType: false,
        success: function(response){

          /**
          * Check for results.
          *
          */
          if ( jQuery.isEmptyObject(JSON.parse(response)) ) {

            /**
            * Notify user on no results.
            *
            */
            swal("We couldn't find any results for your search!");

            /**
            * Focus on the search input.
            *
            */
            $(".society-map-search-input").focus();

            return false;

          }

          /**
          * Set default map boundary.
          *
          */
          var bounds = new google.maps.LatLngBounds();

          /**
          * Create the map and set a default zoom on it.
          *
          */
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14
          });

          /**
          * Loop through each society returned in the response
          * Add each society to the map via a marker.
          *
          */
          $.each(JSON.parse(response), function(idx, obj) {

            /**
            * Craft item HTML.
            *
            */
            var item = '<div class="society-map-list-item"><p class="society-map-list-item-name">'+obj.name+'</p>'

            if (obj.email)
              item = item + '<p class="society-map-list-item-email"><small>'+obj.email+'</small></p>'

            if (obj.link)
              item = item + '<a class="society-map-list-item-button" href="'+obj.link+'" target="_blank">View</a></div>';

            /**
            * Add the item onto the list of societies.
            *
            */
            $(".society-map-list").append(item);

            /**
            * Create the marker based on the location of the society.
            *
            */
            var marker = new google.maps.Marker({
              map: map,
              position: {
                lat: parseFloat(obj.latitude),
                lng: parseFloat(obj.longitude)
              },
              title: obj.name
            });

            /**
            * Add a click listener to each marker,
            * so when it's clicked the map will zoom and focus on it.
            *
            */
            marker.addListener('click', function() {
              map.setZoom(13);
              map.setCenter(marker.getPosition());
            });

            /**
            * Add the position of each marker to the array of boundaries,
            * this is so the map will center on all the markers.
            *
            */
            bounds.extend(marker.position);

          });

          /**
          * Set the bounds of the map.
          *
          */
          map.fitBounds(bounds);

          /**
          * Lets do a cheeky smooth scroll to the map.
          * Just incase the user hasn't got it in view.
          *
          */
          $('html, body').animate({
            scrollTop: $("#map").offset().top - 20
          }, 1000);

        },
        error: function(response) {

          swal("We couldn't find any results for your search. Please try again.");

        }
      });

      return false;

    });
    </script>
  @endpush

@endsection
