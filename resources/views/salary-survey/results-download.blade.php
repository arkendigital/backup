
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link href="{{ asset("css/vendor.css") }}" rel="stylesheet">
  <link href="{{ asset("css/app.css") }}" rel="stylesheet">

  <div class="website-container">

      <div class="salary-survey-results-container">
        <h3>Average Salary vs Experience</h3>

        <div>
          <canvas id="permanent_salary_experience"></canvas>
        </div>
        <div>
          <canvas id="contractors_salary_experience"></canvas>
        </div>
      </div>

      <div class="salary-survey-results-container">
          <h3>Average Salary vs Experience Per Sector</h3>

          <h4>Life</h4>
          <div>
              <canvas id="salary_sector_life_permanent"></canvas>
          </div>
          <div>
              <canvas id="salary_sector_life_contractor"></canvas>
          </div>

          <h4>GI</h4>
          <div>
              <canvas id="salary_sector_gi_permanent"></canvas>
          </div>
          <div>
              <canvas id="salary_sector_gi_contractor"></canvas>
          </div>

          <h4>Pensions</h4>
          <div>
              <canvas id="salary_sector_pensions_permanent"></canvas>
          </div>
          <div>
              <canvas id="salary_sector_pensions_contractor"></canvas>
          </div>

          <h4>Investments</h4>
          <div>
              <canvas id="salary_sector_investments_permanent"></canvas>
          </div>
          <div>
              <canvas id="salary_sector_investments_contractor"></canvas>
          </div>

          <h4>Others</h4>
          <div>
              <canvas id="salary_sector_other_permanent"></canvas>
          </div>
          <div>
              <canvas id="salary_sector_other_contractor"></canvas>
          </div>
      </div>


       <div class="salary-survey-results-container">
        <h3>Average Salary Per Sector</h3>

        <div>
          <canvas id="salary_per_sector_permanent"></canvas>
        </div>
        <div>
          <canvas id="salary_per_sector_contractors"></canvas>
        </div>

        <div>
          <canvas id="salary_per_field_permanent"></canvas>
        </div>
        <div>
          <canvas id="salary_per_field_contractors"></canvas>
        </div>
      </div>


       <div class="salary-survey-results-container">
        <h3>Average Salary v Exam Progress</h3>

        <div>
          <canvas id="salary_vs_exam_progress_permanent"></canvas>
        </div>
        <div>
          <canvas id="salary_vs_exam_progress_contractors"></canvas>
        </div>
      </div>

  </div><!-- /.website-container -->




    <script src="{{ asset("js/vendor.js") }}"></script>
    <script src="{{ asset("js/editor.js") }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
    var myChart = new Chart(document.getElementById('permanent_salary_experience').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_vs_exerience_permanent->one_four }},
                  {{ $salary_vs_exerience_permanent->five_nine }},
                  {{ $salary_vs_exerience_permanent->ten_fourteen }},
                  {{ $salary_vs_exerience_permanent->fifteen_ninteen }},
                  {{ $salary_vs_exerience_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees',
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('contractors_salary_experience').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_vs_exerience_contractor->one_four }},
                  {{ $salary_vs_exerience_contractor->five_nine }},
                  {{ $salary_vs_exerience_contractor->ten_fourteen }},
                  {{ $salary_vs_exerience_contractor->fifteen_ninteen }},
                  {{ $salary_vs_exerience_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_life_permanent').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_life_permanent->one_four }},
                  {{ $salary_sector_life_permanent->five_nine }},
                  {{ $salary_sector_life_permanent->ten_fourteen }},
                  {{ $salary_sector_life_permanent->fifteen_ninteen }},
                  {{ $salary_sector_life_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_life_contractor').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_life_contractor->one_four }},
                  {{ $salary_sector_life_contractor->five_nine }},
                  {{ $salary_sector_life_contractor->ten_fourteen }},
                  {{ $salary_sector_life_contractor->fifteen_ninteen }},
                  {{ $salary_sector_life_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_gi_permanent').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_gi_permanent->one_four }},
                  {{ $salary_sector_gi_permanent->five_nine }},
                  {{ $salary_sector_gi_permanent->ten_fourteen }},
                  {{ $salary_sector_gi_permanent->fifteen_ninteen }},
                  {{ $salary_sector_gi_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_gi_contractor').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_gi_contractor->one_four }},
                  {{ $salary_sector_gi_contractor->five_nine }},
                  {{ $salary_sector_gi_contractor->ten_fourteen }},
                  {{ $salary_sector_gi_contractor->fifteen_ninteen }},
                  {{ $salary_sector_gi_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_pensions_permanent').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_pensions_permanent->one_four }},
                  {{ $salary_sector_pensions_permanent->five_nine }},
                  {{ $salary_sector_pensions_permanent->ten_fourteen }},
                  {{ $salary_sector_pensions_permanent->fifteen_ninteen }},
                  {{ $salary_sector_pensions_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_pensions_contractor').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_pensions_contractor->one_four }},
                  {{ $salary_sector_pensions_contractor->five_nine }},
                  {{ $salary_sector_pensions_contractor->ten_fourteen }},
                  {{ $salary_sector_pensions_contractor->fifteen_ninteen }},
                  {{ $salary_sector_pensions_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_investments_permanent').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_investments_permanent->one_four }},
                  {{ $salary_sector_investments_permanent->five_nine }},
                  {{ $salary_sector_investments_permanent->ten_fourteen }},
                  {{ $salary_sector_investments_permanent->fifteen_ninteen }},
                  {{ $salary_sector_investments_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_investments_contractor').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_investments_contractor->one_four }},
                  {{ $salary_sector_investments_contractor->five_nine }},
                  {{ $salary_sector_investments_contractor->ten_fourteen }},
                  {{ $salary_sector_investments_contractor->fifteen_ninteen }},
                  {{ $salary_sector_investments_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_other_permanent').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_other_permanent->one_four }},
                  {{ $salary_sector_other_permanent->five_nine }},
                  {{ $salary_sector_other_permanent->ten_fourteen }},
                  {{ $salary_sector_other_permanent->fifteen_ninteen }},
                  {{ $salary_sector_other_permanent->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#a7b819',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_sector_other_contractor').getContext('2d'), {
        type: 'line',
        data: {
            labels: ["1-4", "5-9", "10-14", "15-19", "20+"],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_sector_other_contractor->one_four }},
                  {{ $salary_sector_other_contractor->five_nine }},
                  {{ $salary_sector_other_contractor->ten_fourteen }},
                  {{ $salary_sector_other_contractor->fifteen_ninteen }},
                  {{ $salary_sector_other_contractor->twenty_plus }}
                ],
                backgroundColor: 'transparent',
                borderColor: '#ef7900',
                borderWidth: 2
            }]
        },
        options: {
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_per_sector_permanent').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Life', 'GI', 'Pensions', 'Investments', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_sector_permanent->life }},
                  {{ $salary_per_sector_permanent->gi }},
                  {{ $salary_per_sector_permanent->pensions }},
                  {{ $salary_per_sector_permanent->investments }},
                  {{ $salary_per_sector_permanent->other }}
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
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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

    var myChart = new Chart(document.getElementById('salary_per_field_permanent').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Consultancy', 'Insurance', 'Reinsurance', 'Other'],
            datasets: [{
                label: '',
                data: [
                  {{ $salary_per_field_permanent->consultancy }},
                  {{ $salary_per_field_permanent->insurance }},
                  {{ $salary_per_field_permanent->reinsurance }},
                  {{ $salary_per_field_permanent->other }}
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
          responsive: true, animation: false,
          title: {
					  display: true,
					  text: 'Permanent Employees'
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
                    labelString: 'Average Salary Per Year (£k)',
                    fontSize: 10
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
          responsive: true, animation: false,
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
                    labelString: 'Average Salary Per Day (£)',
                    fontSize: 10
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



    var myChart = new Chart(document.getElementById('salary_vs_exam_progress_contractors').getContext('2d'), {
       type: 'bar',
       data: {
           labels: ['1-4', '5-9', '10-12', '13+', 'Qualified'],
           datasets: [{
               label: '',
               data: [
                 {{ $salary_vs_exams_contractor->one_four }},
                 {{ $salary_vs_exams_contractor->five_nine }},
                 {{ $salary_vs_exams_contractor->ten_twelve }},
                 {{ $salary_vs_exams_contractor->thirteen_plus }},
                 {{ $salary_vs_exams_contractor->qualified }}
               ],
               backgroundColor: [
                 '#3cb4e7',
                 '#7b8094',
                 '#4692c8',
                 '#4692c8',
                 '#4692c8',
               ],
               borderColor: 'transparent',
               borderWidth: 0
           }]
       },
       options: {
         responsive: true, animation: false,
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
                   labelString: 'Average Salary Vs Exams Passed (£)',
                   fontSize: 10
                 },
                 ticks: {
                     beginAtZero:true
                 }
             }],
             xAxes: [{
                 scaleLabel: {
                   display: true,
                   labelString: 'Exams Passed'
                 },
                 ticks: {
                     beginAtZero:true
                 }
             }]
         }
       }
    });

    var myChart = new Chart(document.getElementById('salary_vs_exam_progress_permanent').getContext('2d'), {
      type: 'bar',
      data: {
          labels: ['1-4', '5-9', '10-12', '13+', 'Qualified'],
          datasets: [{
              label: '',
              data: [
                {{ $salary_vs_exams_permanent->one_four }},
                {{ $salary_vs_exams_permanent->five_nine }},
                {{ $salary_vs_exams_permanent->ten_twelve }},
                {{ $salary_vs_exams_permanent->thirteen_plus }},
                {{ $salary_vs_exams_permanent->qualified }}
              ],
              backgroundColor: [
                '#3cb4e7',
                '#7b8094',
                '#4692c8',
                '#4692c8',
                '#4692c8',
              ],
              borderColor: 'transparent',
              borderWidth: 0
          }]
      },
      options: {
        responsive: true, animation: false,
        title: {
                    display: true,
                    text: 'Permanent Employees'
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
                  labelString: 'Average Salary Vs Exams Passed (£k)',
                  fontSize: 10
                },
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: 'Exams Passed'
                },
                ticks: {
                    beginAtZero:true
                }
            }]
        }
      }
    });

    $(function() {
        window.print();
    });
    </script>
