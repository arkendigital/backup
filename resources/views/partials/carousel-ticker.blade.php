<a href="{{ $page->section->getField("exams", "exam_carousel_link") }}">
  <div class="carousel">
      <div class="ticker">
          @foreach (json_decode($page->section->getField("exams", "exam_carousel")) as $item)
              <p class="ticker__item">{{ $item }}</p>
          @endforeach
      </div>
  </div>
</a>
