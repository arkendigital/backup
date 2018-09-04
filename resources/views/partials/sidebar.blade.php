@if ($sidebar)
    <h4 class="sidebar-menu--title">Explore More</h4>
    @foreach($sidebar->getItems() as $item)
        <a
                href="{{ $item->url }}"
                @if($item->url == "/".request()->path())
                class="active"
                @endif
                @if ($item->new_tab)
                target="_blank"
                @endif
        >{{ $item->text }}</a>
    @endforeach
@endif
