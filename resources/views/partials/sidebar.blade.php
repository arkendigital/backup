@if($sidebar)
  @foreach($sidebar->getItems() as $item)
    <a href="{{ $item->url }}" @if($item->url == "/".request()->path()) class="active" @endif>{{ $item->text }}</a>
  @endforeach
@endif
