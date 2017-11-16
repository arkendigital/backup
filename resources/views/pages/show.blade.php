@extends('layouts.master')

@section('content')
<div class="gamefront__container" style="margin-top: 10px;">
    @if ($page->image)
    <div class="box profile__header"
         style='background-image: url("{{asset($page->image)}}"); min-height: 300px; margin-top: 20px;'>
    </div>
    @endif
    <div class="box box--with-margin">
        <h3 class="forum__category">{{$page->title}}</h3>
        <p>{!! $page->body !!}</p>
    </div>
</div>
@endsection
