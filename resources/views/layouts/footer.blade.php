<div class="clear"></div>

<footer>

  <div class="footer-social">
    <span>FIND US ON SOCIAL MEDIA</span>
    <a href="{{ $facebook }}" target="_blank" class="footer-social--facebook"><i class="fab fa-facebook"></i></a>
    <a href="{{ $twitter }}" target="_blank" class="footer-social--twitter"><i class="fab fa-twitter-square"></i></a>
    <a href="{{ $linkedin }}" target="_blank" class="footer-social--linkedin"><i class="fab fa-linkedin"></i></a>
  </div>

  <nav class="footer-nav">
    <ul>
      @foreach ($footer_menu->links as $url)
          <li>
            <a href="{{ $url->link }}">{{ $url->text }}</a>
          </li>
      @endforeach
    </ul>
  </nav>

  <nav class="footer-nav footer-nav-secondary">
      <ul>
          @foreach ($footer_sub_menu->links as $url)
              <li>
                <a href="{{ $url->link }}">{{ $url->text }}</a>
              </li>
          @endforeach
        </ul>
    {{-- <ul>
      <li>
        <a href="/about">About Actuaries Online</a>
      </li>
      <li>
        <a href="/jobs/advertise-with-us">Advertise With us</a>
      </li>
      <li>
        <a href="/privacy-cookies">Privacy/Cookies</a>
      </li>
      <li>
        <a href="/terms-and-conditions">Terms and Conditions</a>
      </li>
      <li>
        <a href="/contact">Contact</a>
      </li>
    </ul> --}}
  </nav>

</footer>


<i class="fas fa-chevron-circle-up site-scroll-to-top"></i>
