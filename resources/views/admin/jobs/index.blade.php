@extends('adminlte::page')

@section('css')
    <style>
        .dimmed{
            background-color: #eee;
        }
        thead tr th.dt-checkboxes-select-all input{ 
          display: none;
        }
    </style>
@stop
@push("styles-after")
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.checkboxes.css') }}"/>
@endpush

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Job
    </a>
  </div>
  <h1>All Jobs</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Jobs</h3>
        <div class="btn-group pull-right" data-toggle="buttons">
          <label class="btn btn-primary {{ (session('deleted-jobs')) ? '' : 'active' }} toggle_deleted_jobs" data-deleted="0">
            <input type="radio" name="options" id="option1" checked> Without Deleted
          </label>
          <label class="btn btn-primary {{ (session('deleted-jobs')) ? 'active' : '' }} toggle_deleted_jobs" data-deleted="1">
            <input type="radio" name="options" id="option2"> With Deleted
          </label>
        </div>
        <button id="batch-delete" class="pull-right btn btn-danger" style="margin-right:10px;">Batch Delete</button>
        <a href="{{ url('ops/jobs/sort') }}" class="pull-right btn btn-info" style="margin-right:10px;">Sort Jobs</a>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($jobs->isEmpty())
            <table class="table table-hover" id="datatable-checkbox">
                <thead>
                    <tr>
                        <th></th>
                        <th>Recruiter</th>
                        <th>Job Title</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jobs as $job)
                    <tr class="{{ (strtotime($job->end_date)<time()) ? 'dimmed' : '' }}">
                        <td>{{ $job->id }}</td>
                        <td class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ $job->company->name }}</td>
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ $job->title }}</td>
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ date('Y-m-d',strtotime($job->end_date)) }}</td>
                        <td class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">
                          <div class="btn-group">
                            <a class="btn btn-primary btn-small" type="button" href="{{ route('jobs.show', $job->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if(!$job->deleted_at)
                                <a class="btn btn-success btn-small" type="button" href="{{ route('jobs.edit', $job->id) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-danger btn-small" type="button"  onclick="document.getElementById('delete-job-{{ $job->id }}').submit();">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif

                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" id="delete-job-{{ $job->id }}">
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
                <h3 class="text-center">You haven't added any jobs.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection


@push("scripts-after")
<script type="text/javascript" src="{{ asset('js/dataTables.checkboxes.min.js') }}"></script>
<script>
    
    $('document').ready(function(){


        
        var table = $('#datatable-checkbox').DataTable({     
          'columnDefs': [
             {
                'targets': 0,
                'checkboxes': {
                   'selectRow': true
                }
             }
          ],
          'select': {
             'style': 'multi'
          },
          'order': [[1, 'asc']]
       });

        $('#batch-delete').click(function(){
          var rows_selected = table.column(0).checkboxes.selected();

          var selectedIDs = [];

          if(rows_selected.length){
            $.each(rows_selected, function(index, rowId){
              selectedIDs.push(rowId);
            });

            $.ajax({
              type: "POST",
              url: "/ops/jobs/batch-delete",
              data: {
                method_field:"POST",
                selected_ids:selectedIDs
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response){
                location.reload();
              },
              error: function(response) {
                console.log("FAIL");
                console.log(response);
              }
            });


          }
          
        })
        
        $('.toggle_deleted_jobs').click(function(e){
            if($(this).data('deleted')){
                window.location.href = '/ops/jobs?deleted=1';
            }else{
                window.location.href = '/ops/jobs?deleted=0';
            }
        });
    });

</script>
@endpush