<div class="discussion-sidebar">

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

  <div class="discussion-sidebar__categories">
    <ul>
      <li>
        <a href="/discussion/popular-threads">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/popular-threads.png") }}"></div>
          <span>Discuss this Article</span>
        </a>
      </li>
      <li>
        <a href="/discussion">
          <div class="icon-container"><img src="{{ asset("/images/icons/discussion/all-threads.png") }}"></div>
          <span>General Chat</span>
        </a>
      </li>
    </ul>

  </div>

  {{-- <h4 class="sidebar-menu--title">Author: {{ $article->user->name }}</h4>
  <span class="muted">{{ $article->created_at->diffForHumans() }}</span> --}}

</div><!-- /.discussion-sidebar -->
