<header>
  <div>
    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="header-logo">
    </a>

    <a href="mailto:{{ Setting::get("header_email") }}" class="header-email">{{ Setting::get("header_email") }}</a>

    <div class="header-account @if(auth()->check()) header-account--is-loggedin @endif">
      @if(auth()->check())
        @if(auth()->user()->isAdmin())
          <a href="/ops" target="_blank">Admin<span class="header-account-oval"></span></a>
        @endif
        <a href="{{ route("account.index") }}">{{ auth()->user()->first_name }}<span class="header-account-oval"></span></a>
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
        <li @if(request()->route()->getName() == "index") class="home-active" @endif>
          <a href="/">
              <i class="fas fa-home"></i>
          </a>
        </li>
        <li @if(request()->route()->getPrefix() == "/exams") class="exams-active" @endif>
          <a href="/exams">Exams</a>
          <i class="fas fa-angle-down"></i>
          <ul>
            @foreach($navigation_items['exams'] as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/jobs") class="jobs-active" @endif>
          <a href="/jobs/vacancies">Jobs</a>
          <i class="fas fa-angle-down"></i>
          <ul>
            @foreach($navigation_items['jobs'] as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/continued-professional-development") class="cpd-active" @endif>
          <a href="/continued-professional-development">CPD</a>
          <i class="fas fa-angle-down"></i>
          <ul>
            @foreach($navigation_items['cpd'] as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/salary-survey") class="salary-survey-active" @endif>
          <a href="/salary-survey">Salary Survey</a>
          <i class="fas fa-angle-down"></i>

          <ul>
            @foreach($navigation_items['salary-survey'] as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/uni-corner") class="uni-corner-active" @endif>
          <a href="/uni-corner">Uni Corner</a>
          <i class="fas fa-angle-down"></i>
          <ul>
            @foreach($navigation_items['uni-corner'] as $item)
              <li><a href="{{ $item->url }}">{{ $item->text }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/regional-societies") class="regional-societies-active" @endif>
          <a href="/regional-societies">Regional Societies</a>
        </li>
        <li @if(request()->route()->getPrefix() == "/discussion") class="discussion-active" @endif>
          <a href="/discussion">Discussion</a>
          <i class="fas fa-angle-down"></i>
          <ul>
            @foreach(App\Models\DiscussionCategory::all() as $navigation_discussion_category)
              <li><a href="{{ $navigation_discussion_category->getURL }}">{{ $navigation_discussion_category->name }}</a></li>
            @endforeach
          </ul>
        </li>
        <li @if(request()->route()->getPrefix() == "/recruiters") class="cvsupport-active" @endif>
          <a href="/recruiters">Recruiters</a>
        </li>
      </ul>
    </nav>

    <div class="header-search">
      <form action="{{ route('search') }}" method="" class="search-form">
        <img src="/images/icons/search.png" alt="" title="">
        {{-- <input type="text" name="q" placeholder="Search"> --}}
        <span>Search</span>
      </form>
    </div>

    <a href="/" class="header-home">
        <i class="fas fa-home"></i>
    </a>

    <div class="header-burger">
      <div class="header-burger-icon">
        <div></div>
        <div></div>
        <div></div>
      </div>

      <span class="header-burger-text">Menu</span>
    </div>

    <i class="fas fa-search header-search-icon"></i>

  </div>
</header>

@include("partials.search")

<div class="navigation-overlay"></div>

@if(request()->route()->getPrefix() != "/discussion")
    {{-- <a class="discussion-floater @if(request()->route()->getName() == "suggestfeature.index") feature-floater--full @endif" href="/discussion">
        <div>
          <i class="far fa-3x fa-smile discussion-floater-icon"></i>
          <p class="discussion-floater-title">{{ $l_sticky_button }}</p>
          <p class="discussion-floater-text">Here</p>
        </div>
    </a> --}}
@endif

@if(request()->route()->getName() != "suggestfeature.index")
    {{-- <a class="feature-floater @if(request()->route()->getPrefix() == "/discussion") feature-floater--full @endif" href="{{ route("suggestfeature.index") }}">
        <div>
          <i class="fas fa-2x fa-bug discussion-floater-icon"></i>
          <p class="discussion-floater-title">{{ $r_sticky_button }}</p>
          <p class="discussion-floater-text">Click Here</p>
        </div>
    </a> --}}
@endif
