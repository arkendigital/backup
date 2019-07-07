@extends('adminlte::page')

@section('content_header')
  @if(auth()->user()->hasRole("Super Administrator"))
    <div class="pull-right">
      <a href="{{ route('support-blocks.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Support Block
      </a>
    </div>
  @endif
  <h1>All Support Blocks</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($supportBlocks->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($supportBlocks as $supportBlock)
              <tr>
                <td>{{ $supportBlock->title }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('support-blocks.edit', $supportBlock->id) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                    @if (auth()->user()->hasRole("Super Administrator"))
                        <form action="{{ route('support-blocks.destroy', $supportBlock) }}" method="POST" id="delete-widget-{{$supportBlock->id}}" style="float:left;">
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
            <h3 class="text-center">There are no support blocks yet.</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
