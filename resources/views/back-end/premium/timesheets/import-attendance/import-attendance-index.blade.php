@extends('back-end.premium.layout.premium-main')

@section('content')
    <section class="main-contant-section">
        <div class="">

            @if (Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach

            <div class="content-box">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Import</h3>
                        <div id="form_result"></div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Import CSV file only</h3>
                        <p class="card-text">The first line in downloaded csv file should remain as it is. Please do not
                            change
                            the order of columns in csv file.</p>
                        <p class="card-text">1. The correct column order is <span style="color: red;font-size:20px;">
                                ( Company_assigned_id,Attendance Date, Clock
                                In,
                                Clock Out )</span> and you must follow the csv file,
                            otherwise you will get an <span style="color: red;font-size:20px;"> error </span> while
                            importing the csv file.</p>
                            <p class="card-text">2. If an employee has no attendance then the attendance_date, clock_in & clock_out Columns must be left blank of that employee.</p>
                            <p class="card-text">3. Attendance_date, clock_in & clock_out Columns should be kept blank for Fridays and other holidays</p>

                        <h6>
                            {{-- <a href="{{ asset('uploads/import-samples/attendance-import-sample.xlsx') }}" class="btn btn-success" download> <i class="fa fa-download"></i> Download sample File </a> --}}
                            <a href="{{ asset('uploads/import-samples/attandance.xlsx') }}" class="btn btn-success" download> <i class="fa fa-download"></i> Download sample File </a>
                        </h6>

                        <form method="post" enctype="multipart/form-data" action="{{ route('file-attendance-imports') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <fieldset class="form-group">
                                            <label for="logo">Upload File</label>
                                            <input type="file" class="form-control-file" id="file" name="file"
                                                accept=".xlsx, .xls, .csv">
                                            <small id="error" style="color: red;
                                            font-weight: bold;">Allowed formats are .xlsx, .xls, and .csv. (allowed file size 2MB)</small>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="form-actions box-footer">
                                    <button name="import_form" type="submit" class="btn btn-grad"><i
                                            class="fa fa fa-check-square-o"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $('#user-table').DataTable({


                dom: '<"row"lfB>rtip',

                buttons: [{
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });



            // Validate file input on form submission
            $('form').submit(function() {
                var fileInput = $('#file');
                var filePath = fileInput.val();
                var allowedExtensions = /(\.xlsx|\.xls|\.csv)$/i;

                // Check if a file is selected
                if (fileInput.get(0).files.length === 0) {
                    // No file selected, show error message
                    $('#error').text('Please select a file.');
                    return false;
                }

                // Check if the file extension is allowed
                if (!allowedExtensions.test(filePath)) {
                    // Invalid file extension, show error message
                    $('#error').text('Invalid file format. Allowed formats are .xlsx, .xls, and .csv. (allowed file size 2MB)');
                    return false;
                }

                // File is valid, proceed with form submission
                return true;
            });


        });
    </script>
@endsection

