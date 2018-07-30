@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('exam-categories.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Add Category
    </a>
  </div>
  <h1>All Exam Categories</h1>
  <br>
@stop

@section('content')


    <div class="box box-primary">
      <div class="box-body">
        <div class="table-responsive">
          @unless ($categories->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
              <tr>
                <td>{{ $category->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('exam-categories.edit', $category) }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small" type="button" onclick="document.getElementById('remove-category-{{ $category->id }}').submit()">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route('exam-categories.destroy', $category) }}" method="POST" id="remove-category-{{ $category->id }}" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @else
            <div class="box__content">
              <h3 class="text-center">There are no exam categories yet.</h3>
            </div>
          @endunless
        </div>
      </div>
    </div>

@endsection
