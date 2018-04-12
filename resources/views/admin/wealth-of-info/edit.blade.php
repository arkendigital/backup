@extends('adminlte::page')


@section('content_header')
  <h1>Edit Information</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Wealth of Information</h3>
    </div>

    <form action="{{ route('wealth.update', $wealth) }}" method="POST" role="form" autocomplete="off">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $wealth->title }}">
            </div>

            <div class="form-group">
                <label for="content">Description</label>
                <input type="text" class="form-control" name="content" placeholder="Description" value="{{ $wealth->content }}">
            </div>

            <div class="form-group">
                <label for="role">Colour</label>
                <select name="colour" id="colour" class="form-control" required="required">
                    <option value="orange" @if ($wealth->colour == 'orange') selected @endif>Orange</option>
                    <option value="red" @if ($wealth->colour == 'red') selected @endif>Red</option>
                    <option value="blue" @if ($wealth->colour == 'blue') selected @endif>Blue</option>
                </select>
            </div>
        </div>

        <div class="box-body">
            <h3>Topics</h3>
            
            <div class="box-infos">

            @if ($wealth->data)
                @foreach ($wealth->data as $key => $data)
                    @if (! $loop->first)
                        <hr>
                    @endif 

                    <div class="box-infos-item">
                        <div class="form-group">
                            <label for="button_text">Button Text</label>
                            <input type="text" class="form-control" name="data[{{ $key }}][button_text]" placeholder="Button Text" value="{{ $data->button_text }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Topic Title</label>
                            <input type="text" class="form-control" name="data[{{ $key }}][title]" placeholder="Title" value="{{ $data->title }}">
                        </div>

                        <div class="form-group">
                            <label for="content">Topic Content</label>
                            <textarea class="form-control editor" name="data[{{ $key }}][content]" >{{ $data->content }}</textarea>
                        </div>

                        <a href="javascript:void(0)" class="remove-box-info" style="color: red">Remove This Topic</a>
                        
                    </div>
                @endforeach
            @endif
            </div>
            
            <br>
            <a href="javascript:void(0)" class="btn btn-primary" id="add-box-info">Add Topic</a>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

 <div class="box-info-template" style="display:none">
    <div data-class="box-infos-item">
        <hr>
    
        <div class="form-group">
            <label for="button_text">Button Text</label>
            <input type="text" class="form-control" name="data[index][button_text]" placeholder="Button Text" value="">
        </div>

        <div class="form-group">
            <label for="title">Box Title</label>
            <input type="text" class="form-control" name="data[index][title]" placeholder="Title" value="">
        </div>

        <div class="form-group">
            <label for="content">Box Content</label>
            <textarea class="form-control editor" name="data[index][content]" ></textarea>
        </div>

    </div>
</div>
@endsection

@push('scripts-after')
<script>
    var count = $('.box-infos-item').length;

    $('#add-box-info').click(function(e) {
        e.preventDefault();

        var html = $('.box-info-template').html();
        html = html.replace(/index/gi, count);

        $('.box-infos').append(html);

        $('div[data-class=box-infos-item]').each(function() {
            $(this).addClass('box-infos-item').removeAttr('data-class');
        });

        count++;        
    });

    $('.remove-box-info').click(function(e) {
        $(this).parent().remove();
    });
</script>
@endpush