@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('employers.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Employer
    </a>
  </div>
  <h1>All Employers</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($employers->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employers as $employer)
              <tr>
                <td>{{ $employer->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('employers.edit', $employer) }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small delete-employer" type="button" data-employer-id="{{$employer->id}}">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route('employers.destroy', $employer) }}" method="POST" id="delete-employer-{{$employer->id}}">
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
            <h3 class="text-center">There are no employers or societies yet, why not create one?</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@push('scripts-after')
  <script>
    $('.delete-employer').on('click', function(){

      var employer_id = $(this).attr("data-employer-id");

      swal({
        title: "Are you sure?",
        text: "This employer will be deleted and cannot be undone",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        closeOnConfirm: false
      },
      function(){
        document.getElementById('delete-employer-'+employer_id).submit();
      });
    });
  </script>
@endpush

@endsection
