<header>
  <div>

    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="header-logo">
    </a>

    <a href="mailto:ask@actuaries.online" class="header-email">ask@actuaries.online</a>

    <div class="header-account">
      @if(auth()->check())
        @if(auth()->user()->isAdmin())
          <a href="/ops" target="_blank">Admin<span class="header-account-oval"></span></a>
        @endif
        <a href="{{ route("account.index") }}">My Account<span class="header-account-oval"></span></a>
        <a onclick="document.getElementById('logout-form').submit()" class="cursor-pointer">Logout<span class="header-account-oval"></span></a>
        <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
      @else
        <a href="{{ route("register") }}">Sign up<span class="header-account-oval"></span></a>
        <a href="{{ route("login") }}?from={{ urlencode(url()->full()) }}">Sign in<span class="header-account-oval"></span></a>
      @endif
    </div>

    <nav>

      @if(auth()->check())
        <div class="nav-account">
          <div>
            <img class="nav-account-avatar" src="{{ auth()->user()->avatar }}" alt="" title="">
            <div class="nav-account-info">
              <p class="nav-account-info-username">{{ auth()->user()->name }}</p>
              <a href="/account">My Account</a>
              <a href="/">Logout</a>
            </div>
          </div>
        </div>
      @endif

      <ul>
        <li @if(request()->route()->getPrefix() == "/exams") class="exams-active" @endif>
          <a href="/exams">Exams</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
          <ul>
            @foreach((new App\Models\SectionSidebar)->getItems("exams") as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/jobs") class="jobs-active" @endif>
          <a href="/jobs">Jobs</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
          <ul>
            @foreach((new App\Models\SectionSidebar)->getItems("jobs") as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/cpd") class="cpd-active" @endif>
          <a href="/cpd">CPD</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
          <ul>
            @foreach((new App\Models\SectionSidebar)->getItems("cpd") as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/salary-survey") class="salary-survey-active" @endif>
          <a href="/salary-survey">Salary Survey</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">

          <ul>
            @foreach((new App\Models\SectionSidebar)->getItems("salary-survey") as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/uni-corner") class="uni-corner-active" @endif>
          <a href="/uni-corner">Uni Corner</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
          <ul>
            @foreach((new App\Models\SectionSidebar)->getItems("uni-corner") as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/regional-societies") class="regional-societies-active" @endif>
          <a href="/regional-societies">Regional Societies</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/discussion") class="discussion-active" @endif>
          <a href="/discussion">Discussion</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
          <ul>
            @foreach(App\Models\DiscussionCategory::all() as $navigation_discussion_category)
              <li><a href="{{ $navigation_discussion_category->getURL }}">{{ $navigation_discussion_category->name }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/cv-support") class="cvsupport-active" @endif>
          <a href="/cv-support">CV Support</a>
        </li>
      </ul>
    </nav>

    <div class="header-search">
      <img src="/images/icons/search.png" alt="" title="">
      <input type="text" placeholder="SEARCH">
    </div>

    <div class="header-burger">
      <div class="header-burger-icon">
        <div></div>
        <div></div>
        <div></div>
      </div>

      <span class="header-burger-text">Menu</span>
    </div>

  </div>
</header>

<div class="navigation-overlay"></div>

@if(request()->route()->getPrefix() != "/discussion")
<a class="discussion-floater" href="/discussion">
  <i class="far fa-3x fa-smile discussion-floater-icon"></i>
  <p class="discussion-floater-title">Join our discussion</p>
  <p class="discussion-floater-text">Here</p>
</a>
@endif
