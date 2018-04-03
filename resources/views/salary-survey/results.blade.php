@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="salary-survey-results-container">
      <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      <a href="{{ $page_adverts[0]["main-content"]["url"] }}" target="_blank">
        <img src="{{ $page_adverts[0]["main-content"]["image"] }}" alt="" title="">
      </a>
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

  @push("scripts-after")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $graph_one->one_four }},
                  {{ $graph_one->five_nine }},
                  {{ $graph_one->ten_fourteen }},
                  {{ $graph_one->fifteen_ninteen }},
                  {{ $graph_one->twenty_plus }}
                ],
                backgroundColor: [
                    'rgba(255, 255, 255, 0)',
                    'rgba(255, 255, 255, 0)',
                    'rgba(255, 255, 255, 0)',
                    'rgba(255, 255, 255, 0)',
                    'rgba(255, 255, 255, 0)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
        						scaleLabel: {
        							display: true,
        							labelString: 'Average Salary (£k)'
        						},
                    ticks: {
                        beginAtZero:true
                    }
                }],
                xAxes: [{
        						scaleLabel: {
        							display: true,
        							labelString: 'Experience in years'
        						},
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
  @endpush

@endsection
