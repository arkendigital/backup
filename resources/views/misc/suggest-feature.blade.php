@extends("layouts.master")

@section("content")

  <div class="website-container view-section">
    <div class="website-container-content website-container-content-full">

      <h1>{{ optional($page)->getField("page_title") }}</h1>

      <p>{!! optional($page)->getField("page_content") !!}</p>

      <form action="{{ route("suggestfeature.submit") }}" method="POST" class="suggest-feature-form">
          {{ csrf_field() }}
          {{ method_field("POST") }}

          <input type="hidden" name="url" value="{{ session()->exists("errors") ? old("url") : url()->previous() }}">

          <div class="suggest-feature-form__item">
              <label for="name">Your Name</label>
              @if($errors->has("name"))
                  <p class="suggest-feature-form__error">{{ $errors->first("name") }}</p>
              @endif
              <input name="name" id="name" placeholder="Enter your name...">
          </div>

          <div class="suggest-feature-form__item">
              <label for="message">Message</label>
              @if($errors->has("message"))
                  <p class="suggest-feature-form__error">{{ $errors->first("message") }}</p>
              @endif
              <textarea name="message" id="message" placeholder="Enter your improvement idea here..."></textarea>
          </div>

          <button>Submit</button>

      </form>

    </div>
  </div>

  <div class="clear"></div>

@endsection
