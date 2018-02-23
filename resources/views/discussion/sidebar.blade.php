<div class="discussion-sidebar">

  <div>
    <form action="/discussion/" method="GET">
      {{ csrf_field() }}
      {{ method_field("POST") }}
      <input type="text" name="search" class="discussion-sidebar-search" placeholder="Search the forum" value="{{ isset($_GET["search"]) ? $_GET["search"] : "" }}">
    </form>
  </div>

  <div>
    <ul>
      <li>
        <a href="/discussion">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/all-threads.png") }}"></div>
          <span>All threads</span>
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
  </div>

  <div>
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

</div><!-- /.discussion-sidebar -->
