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
      <h3>Average Salary vs Experience</h3>
    
      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="permanant_salary_experience"></canvas>
      </div>
      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="contractors_salary_experience"></canvas>
      </div>
    </div>

     <div class="salary-survey-results-container">
      <h3>Average Salary Per Sector</h3>
     
      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="salary_per_sector_permanant"></canvas>
      </div>
      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="salary_per_sector_contractors"></canvas>
      </div>

      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="salary_per_field_permanant"></canvas>
      </div>
      <div style="width:49%; height: 270px; display: inline-block;">
        <canvas id="salary_per_field_contractors"></canvas>
      </div>
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
    var myChart = new Chart(document.getElementById("permanant_salary_experience").getContext('2d'), {
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
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Permanant Employees'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
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

    var myChart = new Chart(document.getElementById("contractors_salary_experience").getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $graph_two->one_four }},
                  {{ $graph_two->five_nine }},
                  {{ $graph_two->ten_fourteen }},
                  {{ $graph_two->fifteen_ninteen }},
                  {{ $graph_two->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Contractors'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
          scales: {
              yAxes: [{
                  scaleLabel: {
                    display: true,
                    labelString: 'Annual Salary (£k)'
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

    var myChart = new Chart(document.getElementById('salary_per_sector_permanant').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Life', 'GI', 'Pensions', 'Investments', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_sector_permanant->life }},
                  {{ $salary_per_sector_permanant->gi }},
                  {{ $salary_per_sector_permanant->pensions }},
                  {{ $salary_per_sector_permanant->investments }},
                  {{ $salary_per_sector_permanant->other }}
                ],
                backgroundColor: [
                  '#bac650',
                  '#f0973d',
                  '#fbdd3d',
                  '#ebab9e',
                  '#8975b1'
                ],
                borderColor: 'transparent',
                borderWidth: 0
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Permanant Employees'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
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
                    labelString: 'Sectors'
                  },
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
        }
    });

     var myChart = new Chart(document.getElementById('salary_per_sector_contractors').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Life', 'GI', 'Pensions', 'Investments', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_sector_contractor->life }},
                  {{ $salary_per_sector_contractor->gi }},
                  {{ $salary_per_sector_contractor->pensions }},
                  {{ $salary_per_sector_contractor->investments }},
                  {{ $salary_per_sector_contractor->other }}
                ],
                backgroundColor: [
                  '#bac650',
                  '#f0973d',
                  '#fbdd3d',
                  '#ebab9e',
                  '#8975b1'
                ],
                borderColor: 'transparent',
                borderWidth: 0
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Contractors'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
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
                    labelString: 'Sectors'
                  },
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
        }
    });

    var myChart = new Chart(document.getElementById('salary_per_field_permanant').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Consultancy', 'Insurance', 'Reinsurance', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_field_permanant->consultancy }},
                  {{ $salary_per_field_permanant->insurance }},
                  {{ $salary_per_field_permanant->reinsurance }},
                  {{ $salary_per_field_permanant->other }}
                ],
                backgroundColor: [
                  '#3cb4e7',
                  '#7b8094',
                  '#4692c8',
                  '#4692c8',
                ],
                borderColor: 'transparent',
                borderWidth: 0
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Permanant Employees'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
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
                    labelString: 'Fields'
                  },
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
        }
    });

     var myChart = new Chart(document.getElementById('salary_per_field_contractors').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Consultancy', 'Insurance', 'Reinsurance', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_field_contractor->consultancy }},
                  {{ $salary_per_field_contractor->insurance }},
                  {{ $salary_per_field_contractor->reinsurance }},
                  {{ $salary_per_field_contractor->other }}
                ],
                backgroundColor: [
                  '#3cb4e7',
                  '#7b8094',
                  '#4692c8',
                  '#4692c8',
                ],
                borderColor: 'transparent',
                borderWidth: 0
            }]
        },
        options: {
          responsive: true,       
          title: {
					  display: true,
					  text: 'Contractors'
				  },     
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          },
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
                    labelString: 'Fields'
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
