<div class="box-select" style="background-image:url({{ $group->image }});">
  <div class="box-select-container">

    <p class="box-select-title margin-top--x-large">Book Your Exam</p>
    <p class="box-select-text"></p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item" href="{{ $item->link }}">{{ $item->title }}</a>
    @endforeach

    <div class="clear margin-bottom--x-large"></div>

  </div>
</div><!-- /.box-select -->
