@extends('dashboard.layouts.user_type.auth')
@section('styles')
    {{-- -------------------------- DataTable -------------------------- --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.bootstrap5.min.css"/>
    {{-- -------------------------- DataTable -------------------------- --}}
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Courses</h5>
                            </div>
                            @if (Auth::user()->role->name === 'teacher')
                                <a href="{{ route('admin.courses.create') }}"
                                   class="btn bg-gradient-primary btn-sm mb-0"
                                   type="button">
                                    +&nbsp; New Course
                                </a>
                            @endif

                            @if (Request::is('courses') && Auth::user()->role->name === 'super-admin')
                                <a href="{{ route('admin.courses.pending') }}"
                                   class="btn bg-gradient-warning btn-sm mb-0"
                                   type="button">
                                    View Pending Courses
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-4">
                            <table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Specialization
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        User
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $loop->index + 1 }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $course->name }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $course->specialization->name }}
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 {{ $course->teacher ? '' : 'text-danger' }}">
                                                {{ $course->teacher ? $course->teacher->name : 'Unknown' }}
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0" title="{{ $course->description }}">
                                                {{ Str::limit($course->description, 10) }}
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold badge badge-xs @if($course->status->value === 'pending') bg-gradient-warning @else bg-gradient-success @endif mb-0">
                                                {{ $course->status }}
                                            </p>
                                        </td>

                                        <td class="text-center">
                                            @if(Auth::user()->role->name === 'super-admin' && $course->status->value === 'pending')
                                                <a href="{{ route('admin.course.accept', $course->id) }}" class="mx-3"
                                                   data-bs-toggle="tooltip" data-bs-original-title="Accept Course">
                                                    <i class="fas fa-check text-secondary"></i>
                                                </a>
                                            @endif
                                            {{--                                            <a href="{{ route('admin.courses.show', $course->id) }}" class="mx-3"--}}
                                            {{--                                               data-bs-toggle="tooltip" data-bs-original-title="Show Course Details">--}}
                                            {{--                                                <i class="fas fa-eye text-secondary"></i>--}}
                                            {{--                                            </a>--}}
                                            @if($course->status->value === 'accepted')
                                                <a href="{{ route('admin.course.members', $course->id) }}" class="mx-3"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="Show Course Members">
                                                    <i class="fas fa-users text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.course.quizzes', $course->id) }}" class="mx-3"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="Show Course Quizzes">
                                                    <i class="fas fa-file-alt text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.course.contents', $course->id) }}" class="mx-3"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="Show Course Contents">
                                                    <i class="fas fa-book text-secondary"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="mx-3"
                                               data-bs-toggle="tooltip" data-bs-original-title="Edit Course">
                                                <i class="fas fa-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.courses.destroy', $course->id) }}" class="mx-3"
                                               data-bs-toggle="tooltip" data-bs-original-title="Delete Course">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- -------------------------- DataTable -------------------------- --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.colVis.min.js"></script>
    <script>
        // Initialize the DataTable with some options
        $(document).ready(function () {
            $('#myDataTable').DataTable({
                // Use server-side processing
                //"processing": true,
                //"serverSide": true,
                // Specify the URL for the data source
                //"ajax": "data.php",
                // Disable sorting on the last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 2
                }],
                language: {
                    // Customize the pagination prev and next buttons
                    'paginate': {
                        'previous': '<span class="fa fa-chevron-left"></span>',
                        'next': '<span class="fa fa-chevron-right"></span>'
                    },
                    // Customize the number of elements to be displayed
                    "lengthMenu": 'Display <select class="form-control input-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select> results'
                },
                // Add buttons for column visibility
                "dom": 'Bfrtip',
                "buttons": [{
                    "extend": 'colvis',
                    "text": 'Show/hide columns'
                }]
            });
        });
    </script>
    {{-- -------------------------- DataTable -------------------------- --}}
@endsection
