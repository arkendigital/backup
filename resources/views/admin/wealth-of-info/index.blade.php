@extends('adminlte::page')


@section('content_header')
  <h1>Wealth of Information</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Wealth of Information</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($wealth->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wealth as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('wealth.edit', $item) }}">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endunless
        </div>
    </div>
</div>
@endsection