@foreach($page->getWidgets() as $widget)
  @if($widget->is_visible)
    @include("widgets.".$widget->widget["slug"], [
      "group" => $widget->getBoxGroup($widget->widget["slug"])
    ])
  @endif
@endforeach
