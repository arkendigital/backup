@foreach($navigation_items['exams'] as $item)
    <a href="{{ $item->url }}" @if(isset($key) && $key == "vacancies") class="active" @endif>{{ $item->text }}</a>
@endforeach