<header>
  <div>

    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="header-logo">
    </a>

    <a href="mailto:ask@actuaries.online" class="header-email">ask@actuaries.online</a>

    <div class="header-account">
      @if(auth()->check())
        <a href="{{ route("account.index") }}">My Account<span class="header-account-oval"></span></a>
        <a onclick="document.getElementById('logout-form').submit()">Logout<span class="header-account-oval"></span></a>
        <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
      @else
        <a href="{{ route("register") }}">Sign up<span class="header-account-oval"></span></a>
        <a href="{{ route("login") }}">Sign in<span class="header-account-oval"></span></a>
      @endif
    </div>

    <nav>
      <ul>
        <li @if(request()->route()->getPrefix() == "/exams") class="exams-active" @endif>
          <a href="/exams">Exams</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/jobs") class="jobs-active" @endif>
          <a href="/jobs">Jobs</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/cpd") class="cpd-active" @endif>
          <a href="/cpd">CPD</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/salary-survey") class="salary-survey-active" @endif>
          <a href="">Salary Survey</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/uni-corner") class="uni-corner-active" @endif>
          <a href="/uni-corner">Uni Corner</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/regional-societies") class="regional-societies-active" @endif>
          <a href="/regional-societies">Regional Societies</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
        </li>
        <li @if(request()->route()->getPrefix() == "/discussion") class="discussion-active" @endif>
          <a href="/discussion">Discussion</a>
          <img src="/images/icons/arrow-down.png" alt="" title="">
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

  </div>
</header>

<div class="discussion-floater">

</div>
