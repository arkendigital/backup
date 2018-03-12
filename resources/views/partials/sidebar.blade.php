@if($sidebar)
  @foreach($sidebar->getItems() as $item)
    <a href="{{ $item->url }}" @if(isset($key) && $key == "links") class="active" @endif>{{ $item->text }}</a>
  @endforeach
@endif
