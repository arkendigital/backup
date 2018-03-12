@extends('adminlte::page')

@section('content_header')
    <h1>Exam Category - {{ $category->name }}</h1>
@endsection

@section('content')

<form action="{{ route('exam-categories.update', compact('category')) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Category Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this category..." value="{{ $category->name }}">
      </div>

    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Exam Modules</h3>
      <a class="btn btn-primary pull-right" href="{{ route("exam-modules.create") }}?category_id={{ $category->id }}">Add Module</a>
    </div>
    <div class="box-body">

      @if($category->getModules()->isEmpty())

        <p>There are no modules yet.</p>

      @else

        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($category->getModules() as $module)
              <tr>
                <td>{{ $module->name }} - {{ $module->info->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('exam-modules.edit', $module) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      @endif

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Category</button>
  </div>

</form>

@endsection
