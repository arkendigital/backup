<h4 class="sidebar-menu--title">Explore More</h4>

@foreach($navigation_items['jobs'] as $item)
    <a href="{{ $item->url }}" @if(isset($key) && $key == "vacancies") class="active" @endif>{{ $item->text }}</a>
@endforeach