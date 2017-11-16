@extends('adminlte::page')

@section('content_header')
    <h1>All Reports</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Reports</h3>
        <div class="box-tools">
            {{ $reports->links('vendor.pagination.small-default') }}
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($reports->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($reports as $report)
                    <tr @if($report->status == 'closed') class="success" style="opacity: 0.25" @elseif ($report->status == 'claimed') class="warning" @else class="danger" @endif>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->title }}</td>
                        <td>{{ ucwords($report->status) }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-small" type="button" href="{{ route('reports.show', $report) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="box__content">
                    <h3 class="text-center">There aren't any reports! :)</h3>
                    <img src="{{ asset('storage/images/admin/no-reports-error.jpg') }}" class="center-block" alt="">
                </div>
            @endunless
        </div>
    </div>
    @unless($reports->isEmpty())
    <div class="box-footer">
        {{ $reports->links('vendor.pagination.small-default') }}
    </div>
    @endunless
</div>
@endsection


