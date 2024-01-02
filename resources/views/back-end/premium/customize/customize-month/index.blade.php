@extends('back-end.premium.layout.premium-main')
@section('content')

    <section class="main-contant-section">
        
        <div class=" mb-3">
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
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h1 class="card-title text-center"> {{ __('Customize Month') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        @if ($add_permission == 'Yes')
                            <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                        class="icon icon-plus"> </span>Add</a></li>
                        @endif
                        <li><a href="#">List - Customize Month</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Add Modal Starts -->

        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ _('Customize Month') }}</h5>
                        <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                                class="dripicons-cross"></i></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{ route('add-month-config') }}" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Start Month </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                        <select name="start_month" id="start_month" class="form-control" required>
                                            <option value="">Select Start Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Start Month </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                        <div id="nextMonthInput"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label> Month Name </label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                        <div id="monthName"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>
                                    <!-- <input type="submit" name="action_button" class="btn btn-grad" value="{{ __('Add') }}"/> -->

                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

        <!-- Add Modal Ends -->
        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Month Name') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                            <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($customize_months as $customize_month)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $customize_month->customize_month_name ?? null }}</td>
                                <td>{{ $customize_month->start_date }}-{{ $customize_month->start_month }}</td>
                                <td>{{ $customize_month->end_date }}-{{ $customize_month->next_month }}</td>
                                @if ($edit_permission == 'Yes' || $delete_permission == 'Yes')
                                    <td>
                                        @if ($edit_permission == 'Yes')
                                            <a href="javascript:void(0)" class="btn edit"
                                                data-id="{{ $customize_month->id }}" data-toggle="tooltip" title=""
                                                data-original-title=" Edit "> <i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i> </a>
                                        @endif
                                        @if ($delete_permission == 'Yes')
                                            <a href="{{ route('delete-month-config', ['id' => $customize_month->id]) }}" onclick="return confirm('Are you sure?')"
                                                data-toggle="tooltip" title="" data-original-title="Delete"
                                                class="btn btn-danger delete-post"><i class="fa fa-trash"
                                                    aria-hidden="true"></i> </a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </section>
    <!-- edit boostrap model -->
    <div class="modal fade" id="edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxModelTitle"></h4>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update-month-config') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">


                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label for="name" class="col-sm-12 control-label">Month Name</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="text" name="customize_month_name_update" id="customize_month_name_update"
                                    class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10 mt-4">
                            <button type="submit" class="btn btn-grad">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#start_month').change(function() {
                var selectedOption = $(this).find('option:selected');
                var selectedMonth = parseInt(selectedOption.val());
                var nextOption = selectedOption.next();

                if (nextOption.length === 0) {
                    nextOption = $(this).find('option:first-child');
                }

                var nextMonthValue = parseInt(nextOption.val());
                var nextMonthName = nextOption.text();

                // If the selected option is "Select Start Month", clear the input fields
                if (selectedMonth === "") {
                    nextMonthValue = "";
                    nextMonthName = "";
                } else if (selectedMonth === 12) {
                    nextMonthValue = 1;
                    nextMonthName = "January";
                }

                // Generate HTML
                var html = '<input type="text" name="next_month_name" class="form-control" value="' +
                    nextMonthName +
                    '" readonly> <input type="hidden" name="next_month" value="' + nextMonthValue +
                    '" readonly>';

                // Append HTML to nextMonthInput div
                $('#nextMonthInput').html(html);
                $('#monthName').html('<input type="text" name="customize_month_name">');
            });

            //value retriving and opening the edit modal starts
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: 'edit-month-config',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#customize_month_name_update').val(res.customize_month_name);
                    }
                });
            });


            $('#user-table').DataTable({

                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,

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


        });
    </script>
@endsection
