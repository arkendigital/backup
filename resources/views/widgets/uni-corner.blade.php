<div class="box-select" style="background-image:url({{ $group->image }});">
  <div class="box-select-container">

    <p class="box-select-title">{{ $group->name }}</p>
    <p class="box-select-text">{{ $group->text }}</p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item" href="{{ $item->link }}">{{ $item->title }}</a>
    @endforeach

    <div class="clear"></div>

    <div class="box-select-search">
      <input type="text" name="unicorner_search" id="unicorner-search">
      <label for="unicorner-search">Search your university</label>
    </div>

    <img src="/images/icons/arrow-down--white.png" alt="Scroll Down" title="Scroll Down">

  </div>
</div><!-- /.box-select -->
