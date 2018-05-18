<div class="box-select" style="background-image:url({{ $group->image }});">
  <div class="box-select-container">

    <p class="box-select-title">{{ $group->name }}</p>
    <p class="box-select-text">{{ $group->text }}</p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item" href="{{ $item->link }}">{{ $item->title }}</a>
    @endforeach

    <div class="clear"></div>

    <p><a href="{{ url('/uni-corner/uni-courses') }}" class="button button--large button--orange">Find Your University</a></p> <br>

    {{-- <div class="box-select-search">
      <input type="text" name="unicorner_search" id="unicorner-search">
      <label for="unicorner-search">Search your university</label>
    </div> --}}


  </div>
</div><!-- /.box-select -->
