<div class="box-select box-select--with-fade box-select--dark-blue" style="background-image:url({{ $group->image }});">
  <div class="box-select-container">

    <p class="box-select-title margin-top--x-large">{{ $group->name }}</p>
    <p class="box-select-text"></p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item" href="{{ $item->link }}" @if($item->external) target="_blank" @endif>{{ $item->title }}</a>
    @endforeach

    <div class="clear margin-bottom--x-large"></div>

  </div>
</div><!-- /.box-select -->
