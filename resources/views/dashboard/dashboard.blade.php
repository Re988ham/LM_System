@extends('dashboard.layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Users</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $counts['studentsCount'] }}
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Teachers</p>
                                <h5 class="font-weight-bolder mb-0">
                                    +{{ $counts['teachersCount'] }}
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Courses</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $counts['coursesCount'] }}
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                                <h5 class="font-weight-bolder mb-0">
                                    $53,000
                                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Trending Courses</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Top 6</span> of this month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Course Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Members
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Rating
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset($course->image) }}"
                                                     class="avatar avatar-sm me-3" alt="xd">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $course->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group mt-2">
                                            @foreach($course->members as $student)
                                                <a href="javascript:" class="avatar avatar-xs rounded-circle"
                                                   data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   title="{{ $student->name }}">
                                                    <img src="{{ asset($student->image) }}" alt="{{ $student->name }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">60%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar @if(true) bg-gradient-info @else bg-gradient-success @endif w-60"
                                                    role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Specializations overview</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">24%</span> this month
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        @foreach ($specializations as $specialization)
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="{{ $specialization->icon }} text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $specialization->name }}</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
    <script>
        window.onload = function () {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar"
                , data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                    , datasets: [{
                        label: "Sales"
                        , tension: 0.4
                        , borderWidth: 0
                        , borderRadius: 4
                        , borderSkipped: false
                        , backgroundColor: "#fff"
                        , data: [450, 200, 100, 220, 500, 100, 400, 230, 500]
                        , maxBarThickness: 6
                    },]
                    ,
                }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , plugins: {
                        legend: {
                            display: false
                            ,
                        }
                    }
                    , interaction: {
                        intersect: false
                        , mode: 'index'
                        ,
                    }
                    , scales: {
                        y: {
                            grid: {
                                drawBorder: false
                                , display: false
                                , drawOnChartArea: false
                                , drawTicks: false
                                ,
                            }
                            , ticks: {
                                suggestedMin: 0
                                , suggestedMax: 500
                                , beginAtZero: true
                                , padding: 15
                                , font: {
                                    size: 14
                                    , family: "Open Sans"
                                    , style: 'normal'
                                    , lineHeight: 2
                                }
                                , color: "#fff"
                            }
                            ,
                        }
                        , x: {
                            grid: {
                                drawBorder: false
                                , display: false
                                , drawOnChartArea: false
                                , drawTicks: false
                            }
                            , ticks: {
                                display: false
                            }
                            ,
                        }
                        ,
                    }
                    ,
                }
                ,
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line"
                , data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                    , datasets: [{
                        label: "Mobile apps"
                        , tension: 0.4
                        , borderWidth: 0
                        , pointRadius: 0
                        , borderColor: "#cb0c9f"
                        , borderWidth: 3
                        , backgroundColor: gradientStroke1
                        , fill: true
                        , data: [50, 40, 300, 220, 500, 250, 400, 230, 500]
                        , maxBarThickness: 6

                    }
                        , {
                            label: "Websites"
                            , tension: 0.4
                            , borderWidth: 0
                            , pointRadius: 0
                            , borderColor: "#3A416F"
                            , borderWidth: 3
                            , backgroundColor: gradientStroke2
                            , fill: true
                            , data: [30, 90, 40, 140, 290, 290, 340, 230, 400]
                            , maxBarThickness: 6
                        }
                        ,]
                    ,
                }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , plugins: {
                        legend: {
                            display: false
                            ,
                        }
                    }
                    , interaction: {
                        intersect: false
                        , mode: 'index'
                        ,
                    }
                    , scales: {
                        y: {
                            grid: {
                                drawBorder: false
                                , display: true
                                , drawOnChartArea: true
                                , drawTicks: false
                                , borderDash: [5, 5]
                            }
                            , ticks: {
                                display: true
                                , padding: 10
                                , color: '#b2b9bf'
                                , font: {
                                    size: 11
                                    , family: "Open Sans"
                                    , style: 'normal'
                                    , lineHeight: 2
                                },
                            }
                        }
                        , x: {
                            grid: {
                                drawBorder: false
                                , display: false
                                , drawOnChartArea: false
                                , drawTicks: false
                                , borderDash: [5, 5]
                            },
                            ticks: {
                                display: true
                                , color: '#b2b9bf'
                                , padding: 20,
                                font: {
                                    size: 11
                                    , family: "Open Sans"
                                    , style: 'normal'
                                    , lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endpush
