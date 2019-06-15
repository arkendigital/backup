@foreach($page->getWidgets() as $widget)
  @if($widget->is_visible)
	@if(View::exists("widgets.".$widget->widget["slug"]))
	    @include("widgets.".$widget->widget["slug"], [
	      "group" => $widget->getBoxGroup($widget->widget["slug"])
	    ])
	@else
		@include("widgets.generic", [
	      "group" => $widget->getBoxGroup($widget->widget["slug"])
	    ])
	@endif
  @endif
@endforeach
