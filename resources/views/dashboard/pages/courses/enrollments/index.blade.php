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
                                <h5 class="mb-0">All Enrollments</h5>
                            </div>
                            @if (Route::currentRouteName() === 'admin.course.members' && Auth::user()->role->name === 'super-admin')
                                <a href="{{ route('admin.course.pending.members', $courseId) }}"
                                   class="btn bg-gradient-warning btn-sm mb-0"
                                   type="button">
                                    View Pending Members
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
                                        User ID
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Course
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
                                @foreach ($members as $member)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $loop->index + 1 }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <a href="{{ $member->user_id }}"
                                                   target="_blank">{{ $member->user->name }}</a>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                <a href="{{ $member->course->name }}"
                                                   target="_blank">{{ $member->course->name }}</a>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold badge badge-xs @if($member->status->value === 'pending') bg-gradient-warning @else bg-gradient-success @endif mb-0">
                                                {{ $member->status }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            @if($member->status->value === 'pending')
                                                <a href="{{ route('admin.enrollments.accept', $member->id) }}"
                                                   class="mx-3"
                                                   data-bs-toggle="tooltip" data-bs-original-title="Accept Member">
                                                    <i class="fas fa-check text-secondary"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.enrollments.destroy', $member->id) }}" class="mx-3"
                                               data-bs-toggle="tooltip" data-bs-original-title="Delete Member">
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
