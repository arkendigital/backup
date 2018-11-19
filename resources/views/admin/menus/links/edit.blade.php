@extends('adminlte::page')

@section('content_header')

    <h1>Create Link</h1>

    @if($errors->any())
        <p class="has-error">
            <br><label class="control-label" for="title"><i class="fa fa-times-circle-o"></i> There are some issues with this Job listing, please see fields marked in red</label>
        </p>
    @endif

@endsection

@section('content')

<form action="{{ route('menulink.update', $link) }}" method="POST" role="form">

    {{ csrf_field() }}
    {{ method_field("PATCH") }}

    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Link Information</h3>
                </div>

                <div class="box-body">

                    <div class="form-group @if($errors->has("text")) has-error @endif">
                      @if($errors->has("text"))
                          <label class="control-label" for="text"><i class="fa fa-times-circle-o"></i> {{ $errors->first("text") }}</label>
                      @else
                          <label for="text">Text</label>
                      @endif

                      <input type="text" class="form-control" name="text" id="text" value="{{ $link->text }}" placeholder="Link Text">
                    </div>

                    <div class="form-group @if($errors->has("link")) has-error @endif">
                        @if($errors->has("link"))
                            <label class="control-label" for="text"><i class="fa fa-times-circle-o"></i> {{ $errors->first("link") }}</label>
                        @else
                            <label for="text">URL</label>
                        @endif

                        <input type="text" class="form-control" name="link" id="link" value="{{ $link->link }}" placeholder="Link URL">
                    </div>

                    <div class="form-group @if($errors->has("order")) has-error @endif">
                            @if($errors->has("order"))
                                <label class="control-label" for="text"><i class="fa fa-times-circle-o"></i> {{ $errors->first("order") }}</label>
                            @else
                                <label for="text">Order</label>
                            @endif
    
                            <input type="text" class="form-control" name="order" id="order" value="{{ $link->order }}" placeholder="Link Order">
                        </div>
                    

                </div>

                <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

            </div>

        </div>
    </div>


</form>

@push("scripts-after")

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
  <script>
  $(function() {
    $(".datepicker").datepicker({
      format: "dd-mm-yyyy",
      startDate: "{{ date("d-m-Y") }}"
    });
  });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/trumbowyg.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/ui/trumbowyg.min.css">
  <script>
    $('.editor').trumbowyg({
      svgPath: '/images/icons.svg',
    });
  </script>
@endpush

@endsection
