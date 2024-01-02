@extends('back-end.premium.layout.premium-main')
@section('content')

<section class="main-contant-section">
    <div class="mb-3">

        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
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

        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Manage Other Holiday') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if ($add_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Other Holiday </a></li>
                </ol>
            </div>
        </div>

        <!-- boostrap model -->
        <div class="modal fade" id="addDepartmentModal" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ajaxBookModel"> Add Holiday </h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('add-other-holidays')}}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            @csrf


                            <input type="hidden" class="form-control" name="holiday_type" value="Other-Holiday"
                                required="">

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="name" class=" control-label">Holiday Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" name="holiday_name"
                                        placeholder="Enter Holiday Name" value="" maxlength="50" required="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="start_date" class=" control-label">Start Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input class="form-control" type="date" name="start_date" value="" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="end_date" class="control-label">End Date</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-calendar"
                                                aria-hidden="true"></i> </span>
                                    </div>
                                    <input class="form-control" type="date" name="end_date" value="" required>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>
                                <!-- <button type="submit" class="btn btn-grad" id="btn-other-save">Save Changes
                                    </button> -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- end bootstrap model -->

        <div class="content-box">

            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>{{__('SL')}}</th>
                            <th>{{__('Holiday Type')}}</th>
                            <th>{{__('Holiday Name')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes' ||
                            Auth::user()->company_profile == 'Yes')
                            <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($holidays as $holiday_value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $holiday_value->holiday_type }}</td>
                            <td>{{ $holiday_value->holiday_name }}</td>
                            <td>{{ $holiday_value->start_date}}</td>
                            <td>{{ $holiday_value->end_date}}</td>

                            @if($edit_permission == 'Yes' || $delete_permission == 'Yes' ||
                            Auth::user()->company_profile == 'Yes')
                            <td>
                                @if($edit_permission == 'Yes' || Auth::user()->company_profile == 'Yes')

                                <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                    data-target="#EditModal{{ $holiday_value->id }}" data-id="" data-toggle="tooltip"
                                    title=" Edit " data-original-title="Edit"> <i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i></a>

                                @endif
                                @if($delete_permission == 'Yes' || Auth::user()->company_profile == 'Yes')
                                <a href="{{route('delete-other-holidays',['id'=>$holiday_value->id])}}"
                                    class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                    data-original-title="Delete"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>


                                @endif
                            </td>
                            @endif
                        </tr>

                        <!-- edit boostrap model -->
                        <div id="EditModal{{$holiday_value->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="ajaxModelTitle"> </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('edit-other-holidays') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $holiday_value->id }}">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group mb-3">
                                                        <label>Holiday Name</label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                                    aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="holiday_name" id="holiday_name"
                                                            class="form-control"
                                                            value="{{ $holiday_value->holiday_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-3">
                                                        <label>Start Date</label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                                    aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="start_date" id="start_date"
                                                            class="form-control" value="{{ $holiday_value->start_date}}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-3">
                                                        <label>End Date</label>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fa fa-calendar"
                                                                    aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="end_date" id="end_date"
                                                            class="form-control" value="{{ $holiday_value->end_date}}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-2 col-sm-10 mt-4">
                                                    <button type="submit" class="btn btn-grad">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end bootstrap model -->

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>

    </div>
</section>






<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#user-table').DataTable({

                "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                "iDisplayLength": 25,
                dom: '<"row"lfB>rtip',

                buttons: [
                    {
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


             //value retriving and opening the edit modal starts

            //  $('.edit').on('click', function () {
            //     var id = $(this).data('id');
            //     $.ajax({
            //         type:"POST",
            //         url: 'edit-other-holiday-getting',
            //         data: {id:id},
            //         dataType: 'json',
            //         success: function(res){
            //         $('#ajaxModelTitle').html("Edit Holiday");
            //         $('#edit-modal').modal('show');
            //         $('#id').val(res.id);
            //         $('#holiday_name').val(res.holiday_name);
            //         $('#start_date').val(res.start_date);
            //         $('#end_date').val(res.end_date);
            //     }
            //     });
            // });

           //value retriving and opening the edit modal ends






    });

</script>

@endsection