<div class="box-select box-select--dark-blue lazy" data-src="{{ $group->image }}">
  <div class="box-select-container">

    <p class="box-select-title margin-top--large">{{ $group->name }}</p>
    <p class="box-select-text">{{ $group->text }}</p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item" href="{{ $item->link }}">{{ $item->title }}</a>
    @endforeach

    <div class="clear margin-bottom--x-large"></div>

  </div>
</div><!-- /.box-select -->
