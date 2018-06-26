@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('uni-societies.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Uni Society
    </a>
  </div>
  <h1>All Uni Societies</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($societies->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($societies as $society)
              <tr>
                <td>{{ $society->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('uni-societies.edit', $society) }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small delete-society" type="button" data-society-id="{{$society->id}}">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route('uni-societies.destroy', $society) }}" method="POST" id="delete-society-{{$society->id}}">
                      {{csrf_field()}}
                      {{method_field("DELETE")}}
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        @else
          <div class="box__content">
            <h3 class="text-center">There are no uni societies yet, why not create one?</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@push('scripts-after')
  <script>
    $('.delete-society').on('click', function(){

      var society_id = $(this).attr("data-society-id");

      swal({
        title: "Are you sure?",
        text: "This society will be deleted and cannot be undone",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        closeOnConfirm: false
      },
      function(){
        document.getElementById('delete-society-'+society_id).submit();
      });
    });
  </script>
@endpush

@endsection
