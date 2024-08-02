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
                                <h5 class="mb-0">All Answers</h5>
                            </div>
                            <a href="{{ route('admin.answers.create', $questionId) }}" class="btn bg-gradient-primary btn-sm mb-0"
                               type="button">
                                +&nbsp; New Answer
                            </a>
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
                                        Text
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Is Correct
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($answers as $answer)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $loop->index + 1 }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $answer->text }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold badge badge-xs @if($answer->is_correct == 0) bg-gradient-secondary @else bg-gradient-success @endif mb-0">
                                                @if($answer->is_correct == 0) Wrong @else Correct @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.answers.edit', $answer->id) }}" class="mx-3"
                                               data-bs-toggle="tooltip" data-bs-original-title="Edit Answer">
                                                <i class="fas fa-edit text-secondary"></i>
                                            </a>
                                            <a href="{{ route('admin.answers.destroy', $answer->id) }}"
                                               class="mx-3" data-bs-toggle="tooltip"
                                               data-bs-original-title="Delete Answer">
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
