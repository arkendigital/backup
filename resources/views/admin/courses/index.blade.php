@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create New Course
    </a>
  </div>
  <h1>All Courses</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($courses->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($courses as $course)
              <tr>
                <td>{{ $course->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('courses.edit', $course) }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small delete-course" type="button" data-course-id="{{$course->id}}">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route('courses.destroy', $course) }}" method="POST" id="delete-course-{{$course->id}}">
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
            <h3 class="text-center">There are no courses yet, why not create one?</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>



@push('scripts-after')
  <script>
    $('.delete-course').on('click', function(){

      var course_id = $(this).attr("data-course-id");

      swal({
        title: "Are you sure?",
        text: "This course will be deleted and cannot be undone",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        closeOnConfirm: false
      },
      function(){
        document.getElementById('delete-course-'+course_id).submit();
      });
    });
  </script>
@endpush

@endsection
