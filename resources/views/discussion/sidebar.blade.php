<div class="discussion-sidebar">

  {{-- <div>
    <form action="/discussion/" method="GET">
      {{ csrf_field() }}
      {{ method_field("POST") }}
      <input type="text" name="search" class="discussion-sidebar-search" placeholder="Search the forum" value="{{ isset($_GET["search"]) ? $_GET["search"] : "" }}">
    </form>
  </div> --}}

  <div class="discussion-sidebar__mobile-menu">
      <ul>
          <li>
            <a>
              <div class="icon-container"><img src="{{ asset("/images/icons/discussion/categories.png") }}"></div>
              <span>Show Categories</span>
            </a>
          </li>
      </ul>
  </div>

  {{-- <div class="discussion-sidebar__categories">
    <ul>
      <li>
        <a href="/discussion">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/all-threads.png") }}"></div>
          <span>All threads</span>
        </a>
      </li>
      <li>
        <a href="/discussion/latest-messages">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/latest.png") }}"></div>
          <span>Latest Messages</span>
        </a>
      </li>
      <li>
        <a href="/discussion/popular-threads">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/popular-threads.png") }}"></div>
          <span>Popular threads</span>
        </a>
      </li>
      <li>
        <a href="/discussion/answered-threads">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/answered.png") }}"></div>
          <span>Answered</span>
        </a>
      </li>
      <li>
        <a href="/discussion/unanswered-threads">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/unanswered.png") }}"></div>
          <span>Unanswered</span>
        </a>
      </li>
    </ul>
  </div> --}}

  <div class="discussion-sidebar__categories">
    <ul>
      @foreach($categories as $category)
      <li>
        <a href="/discussion/{{ $category->slug }}">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/".$category->icon['icon']) }}"></div>
          <span>{{ $category->name }}</span>
        </a>
      </li>
      @endforeach
    </ul>
  </div>

  <div class="feedgrabbr_widget" id="fgid_c216a28cf657ad35875f797e6" style="overflow: hidden;"></div>
<script>if (typeof (fg_widgets) === "undefined") fg_widgets = new Array(); fg_widgets.push("fgid_c216a28cf657ad35875f797e6");</script>​
<script async src="https://www.feedgrabbr.com/widget/fgwidget.js"></script>

</div><!-- /.discussion-sidebar -->
