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
                        <th>Start Date</th>
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
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ date('Y-m-d',strtotime($job->start_date)) }}</td>
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ date('Y-m-d',strtotime($job->end_date)) }}</td>
                        <td class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">
                          <div class="btn-group">
                            <a class="btn btn-primary btn-small show_states" data-route="{{ route('jobs.show', $job->id) }}" type="button" href="#">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if(!$job->deleted_at)
                                <a class="btn btn-success btn-small edit_job" data-route="{{ route('jobs.edit', $job->id) }}" type="button">
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
    var page = "{{ (Request::has('page') && request()->page !=='') ? request()->page : 0 }}";
    var perPage = "{{ (Request::has('per_page') && request()->per_page !=='') ? request()->per_page : 10 }}";

    function setURLPage(pageNumber, perPage){
      var url = new URL(window.location.href);
      var query_string = url.search;
      var search_params = new URLSearchParams(query_string); 
      search_params.set('page', pageNumber);
      search_params.set('per_page', perPage);
      url.search = search_params.toString();
      var new_url = url.toString();
      window.location = new_url;
    }

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

        table.page.len(perPage).page(parseInt(page)).draw('page');

        $('.show_states').click(function(e){
          e.preventDefault();
          statsNavigate(table.page.info().page,perPage,$(this).data('route'));
        });

        $('.edit_job').click(function(e){
          e.preventDefault();
          statsNavigate(page,perPage,$(this).data('route'))
        });

        $('#datatable-checkbox').on( 'page.dt', function () {
          setURLPage(table.page.info().page,perPage);
        });

        $('#datatable-checkbox').on( 'draw.dt', function () {
          $('.show_states').off('click');
          $('.show_states').click(function(e){
            e.preventDefault();
            statsNavigate(table.page.info().page,perPage,$(this).data('route'));
          });
        });

        $('#datatable-checkbox').on( 'length.dt', function ( e, settings, len ) {
            // setURLPage(parseInt(page),len);
            setURLPage(table.page.info().page,len);
        });

        function statsNavigate(pageNumber,perPage,url)
        {
          window.location = url+'?page='+pageNumber+'&per_page='+perPage;
        }

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