@extends('adminlte::page')

@section('content_header')
  @if(auth()->user()->hasRole("Super Administrator"))
    <div class="pull-right">
      <a href="{{ route('box-groups.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Box Group
      </a>
    </div>
  @endif
  <h1>All Box Groups</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($box_groups->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($box_groups as $group)
              <tr>
                <td>{{ $group->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('box-groups.edit', $group) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                    @if (auth()->user()->hasRole("Super Administrator"))
                        <form action="{{ route('box-groups.destroy', $group) }}" method="POST" id="delete-widget-{{$group->id}}" style="float:left;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger btn-small" type="submit">  <i class="fa fa-trash"></i> </button>
                        </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        @else
          <div class="box__content">
            <h3 class="text-center">There are no box groups yet.</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
