@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('jobs.sectors.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Job Sector
    </a>
  </div>
  <h1>All Job Sectors</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Job Sectors</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($sectors->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Sector Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{{ $sector->name }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('jobs.sectors.edit', $sector) }}">
                              <i class="fa fa-pencil"></i>
                            </a>
                            @if(auth()->user()->can('delete role'))
                            <a class="btn btn-danger btn-small" type="button" id="delete-{{$sector->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endif
                          </div>
                        </td>
                    </tr>
                    <form action="{{ route('jobs.sectors.delete', $sector) }}" method="POST" id="delete-loc-{{$sector->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$sector->id}}').on('click', function(){
                                    swal({
                                        title: "Are you sure?",
                                        text: "This item will be deleted and cannot reverted!",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Yes, delete it!",
                                        closeOnConfirm: false
                                    },
                                    function(){
                                        document.getElementById('delete-loc-{{$sector->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                    @endforeach
                </tbody>
            </table>
            @else
              <div class="box__content">
                <h3 class="text-center">You haven't added any jobs.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
