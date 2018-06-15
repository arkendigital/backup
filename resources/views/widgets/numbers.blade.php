<div class="box-select box-select--with-fade box-select--dark-blue box-select-padding-bottom--large" style="background-image:url({{ $group->image ?? '' }});">
  <div class="box-select-container">

    <p class="box-select-title">Where your numbers add up</p>
    <p class="box-select-text">Get all the latest information on exams, courses and exam centres.</p>

    @foreach($group->getItems() as $item)
      <a class="box-select-item"
        @if ($item->title == 'Past Papers')
          target="_blank"
        @endif
       href="{{ $item->link }}">{{ $item->title }}</a>
    @endforeach

    <div class="clear"></div>

    <a href="/exams" class="box-select-button margin-top--medium">Find out more</a>
  </div>
</div><!-- /.box-select -->
