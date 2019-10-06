@extends('adminlte::page')

@section('content_header')
  <style>
  .slides {
    list-style: none;
    margin: 0;
    padding: 0;
}
.slide {
        height: 40px;
    background-color: #eee;
    width: auto;
    padding: 10px;
    list-style: none;
    border-radius: 10px;
    margin-bottom: 10px;
}

.slide-placeholder {
  background: #3c8dbc;
  position: relative;
  border-radius: 10px;
}
.slide-placeholder:after {
  content: " ";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 15px;
  background-color: #FFF;
}

</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.checkboxes.css') }}"/>
  <h1>All Jobs</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Jobs</h3>
    </div>
    <div class="box-body">



        <div>
            @unless ($jobs->isEmpty())
              <table style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Recruiter</th>
                    <th>Job Title</th>
                    <th>End Date</th>
                  </tr>
                </thead>
              <tbody class="slides">
                @foreach ($jobs as $job)
                    <tr class="slide" id="{{ $job->id }}">
                        <td>{{ $job->id }}</td>
                        <td class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ $job->company->name }}</td>
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ $job->title }}</td>
                        <td  class="{{ ($job->deleted_at) ? 'bg-danger' : '' }}">{{ date('Y-m-d',strtotime($job->end_date)) }}</td>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
    
    $('document').ready(function(){

      $(".slides").sortable({
        placeholder: 'slide-placeholder',
        axis: "y",
        revert: 150,
        start: function(e, ui){
            
            placeholderHeight = ui.item.outerHeight();
            ui.placeholder.height(placeholderHeight + 15);
            $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);
        
        },
        update: function(event, ui) {


          var sortedData = $(this).sortable('toArray');

            $.ajax({
              type: "POST",
              url: "/ops/jobs/sort",
              data: {
                sorted_date:sortedData
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response){
                // location.reload();
              },
              error: function(response) {
                console.log("FAIL");
                console.log(response);
              }
            });

            ui.placeholder.stop().height(0).animate({
                height: ui.item.outerHeight() + 15
            }, 300);
            
            placeholderAnimatorHeight = parseInt($(".slide-placeholder-animator").attr("data-height"));
            
            $(".slide-placeholder-animator").stop().height(placeholderAnimatorHeight + 15).animate({
                height: 0
            }, 300, function() {
                $(this).remove();
                placeholderHeight = ui.item.outerHeight();
                $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);
            });
            
        },
        stop: function(e, ui) {
            
            $(".slide-placeholder-animator").remove();
            
        },
    });
        
    });

</script>
@endpush