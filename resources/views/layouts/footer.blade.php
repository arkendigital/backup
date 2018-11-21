<div class="clear"></div>

<footer>

  @if($facebook || $twitter || $linkedin || $pintrest || $instagram )
  <div class="footer-social">
    <span>FIND US ON SOCIAL MEDIA</span>
    @if($facebook)
      <a href="{{ $facebook }}" target="_blank" class="footer-social--facebook"><i class="fab fa-facebook"></i></a>
    @endif
    @if($twitter)
      <a href="{{ $twitter }}" target="_blank" class="footer-social--twitter"><i class="fab fa-twitter-square"></i></a>
    @endif
    @if($linkedin)
      <a href="{{ $linkedin }}" target="_blank" class="footer-social--linkedin"><i class="fab fa-linkedin"></i></a>
    @endif
    @if($pintrest)
      <a href="{{ $pintrest }}" target="_blank" class="footer-social--pintrest"><i class="fab fa-pinterest-square"></i></a>
    @endif
    @if($instagram)
      <a href="{{ $instagram }}" target="_blank" class="footer-social--instagram"><i class="fab fa-instagram"></i></a>
    @endif

  </div>
  @endif

  <nav class="footer-nav">
    <ul>
      @if($footer_menu)
      @foreach ($footer_menu->links as $url)
          <li>
            <a href="{{ $url->link }}">{{ $url->text }}</a>
          </li>
      @endforeach
      @endif
    </ul>
  </nav>

  <nav class="footer-nav footer-nav-secondary">
    <ul>
        @if ($footer_sub_menu)
        @foreach ($footer_sub_menu->links as $url)
            <li>
              <a href="{{ $url->link }}">{{ $url->text }}</a>
            </li>
        @endforeach
        @endif
      </ul>
  </nav>

</footer>


<i class="fas fa-chevron-circle-up site-scroll-to-top"></i>
