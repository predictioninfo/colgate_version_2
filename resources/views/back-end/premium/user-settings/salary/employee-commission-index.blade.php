@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<section class="main-contant-section">
    @php
    use App\Models\Package;
    @endphp
    @php
    $permission = "3.28";
    @endphp
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


        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('Commission List') }} </h1>
                <ol id="breadcrumb1">
                    <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                    @if($add_permission == "Yes" || (Auth::user()->company_profile == 'Yes'))
                    <li><a href="#" type="button" data-toggle="modal" data-target="#addModal"><span
                                class="icon icon-plus"> </span>Add</a></li>
                    @endif
                    <li><a href="#">List - Commission </a></li>
                </ol>
            </div>
        </div>

    </div>


    <!-- Add Modal Starts -->

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{ _('Add Commission') }}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                            class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('add-employee-commissions') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- <input type="hidden" name="commission_employee_id"
                            value="{{Session::get('employee_setup_id')}}"> --}}
                        <div class="row">


                            @if (Package::where('id', '=',
                            Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["' . $permission .
                            '"]\')')->exists())

                            <div class="col-md-6 form-group">
                                <label>{{__('Month')}} </label>
                                <select name="month" class="form-control " title='Month' required>
                                    <option value="">Select Month</option>
                                    @foreach($customize_months as $customize_month)
                                    <option value="{{ $customize_month->start_month }}">{{
                                        $customize_month->customize_month_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Year')}} </label>
                                <select name="year" class="form-control " title='Year' required>
                                    <option value="">Select Year</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023" selected>2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                    <option value="2036">2036</option>
                                    <option value="2037">2037</option>
                                    <option value="2038">2038</option>
                                    <option value="2039">2039</option>
                                    <option value="2040">2040</option>
                                    <option value="2041">2041</option>
                                    <option value="2042">2042</option>
                                    <option value="2043">2043</option>
                                    <option value="2044">2044</option>
                                    <option value="2045">2045</option>
                                    <option value="2046">2046</option>
                                    <option value="2047">2047</option>
                                    <option value="2048">2048</option>
                                    <option value="2049">2049</option>
                                    <option value="2050">2050</option>
                                </select>
                            </div>

                            @else
                            <div class="col-md-12 form-group">
                                <label>Month-Year</label>
                                <input type="month" name="commission_month_year" class="form-control" value="" required>
                            </div>

                            @endif
                            <div class="col-md-12 form-group">
                                <label>Commission Type</label>
                                <select class="form-control" name="commission_type" required>
                                    <option value="">Select-A-Commission-Type</option>
                                    <option value="Sales-Incentives">Seles/Incentives</option>
                                    <option value="Performance-Bonus">Performance Bonus</option>
                                    <option value="Project-Bonus">Project Bonus</option>
                                    <option value="Other-Commission">Other Commission</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Title</label>
                                <input type="text" name="commission_title" class="form-control" value="" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Amount</label>
                                <input type="text" name="commission_amount" class="form-control" value="" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea name="commission_desc" class="form-control" cols="20" rows="8"
                                    required></textarea>
                            </div>

                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-grad" type="submit"> <i class="fa fa-plus"
                                        aria-hidden="true"></i> Add </button>

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
                        <th>{{ __('Month Year') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Ammount') }}</th>
                        @if ($add_permission == 'Yes' ||
                        $edit_permission == 'Yes' ||
                        $delete_permission == 'Yes' ||
                        Auth::user()->company_profile == 'Yes')
                        <th>{{ __('Action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($commissions as $commissions_value)
                    <tr>
                        <td>{{ $i++ }}</td>
                        @if (Package::where('id', '=',
                        Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["' . $permission .
                        '"]\')')->exists())
                        <td>{{ $commissions_value->customize_commission_month }}-{{
                            $commissions_value->customize_commission_year }}</td>
                        @else
                        <td>{{ $commissions_value->commission_month_year }}</td>
                        @endif
                        <td>{{ $commissions_value->commission_type }}</td>
                        <td>{{ $commissions_value->commission_title }}</td>
                        <td>{{ $commissions_value->commission_desc }}</td>
                        <td>{{ $commissions_value->commission_amount }}</td>
                        @if ($edit_permission == 'Yes' || $delete_permission == 'Yes' || Auth::user()->company_profile
                        == 'Yes')
                        <td>
                            <a href="javascript:void(0)" class="btn edit editModal"
                                data-id="{{ $commissions_value->id }}" data-toggle="tooltip" title="Edit"
                                data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="{{ route('delete-employee-commissions', ['id' => $commissions_value->id]) }}"
                                class="btn btn-danger delete delete-post" data-toggle="tooltip" title="Delet"
                                data-original-title="Delet"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#e60707;">
                <h4 class="modal-title" id="ajaxModelTitle"></h4>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i
                        class="dripicons-cross"></i></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        @if (Package::where('id', '=',
                        Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["' . $permission .
                        '"]\')')->exists())

                        <div class="col-md-6 form-group">
                            <label>{{__('Month')}} </label>
                            <select name="month" class="form-control " title='Month' required>
                                <option value="">Select Month</option>
                                @foreach($customize_months as $customize_month)
                                <option value="{{ $customize_month->start_month }}">{{
                                    $customize_month->customize_month_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('Year')}} </label>
                            <select name="year" class="form-control " title='Year' required>
                                <option value="">Select Year</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023" selected>2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                                <option value="2033">2033</option>
                                <option value="2034">2034</option>
                                <option value="2035">2035</option>
                                <option value="2036">2036</option>
                                <option value="2037">2037</option>
                                <option value="2038">2038</option>
                                <option value="2039">2039</option>
                                <option value="2040">2040</option>
                                <option value="2041">2041</option>
                                <option value="2042">2042</option>
                                <option value="2043">2043</option>
                                <option value="2044">2044</option>
                                <option value="2045">2045</option>
                                <option value="2046">2046</option>
                                <option value="2047">2047</option>
                                <option value="2048">2048</option>
                                <option value="2049">2049</option>
                                <option value="2050">2050</option>
                            </select>
                        </div>
                        @else
                        <div class="col-md-12 form-group">
                            <label>Month-Year</label>
                            <input type="month" name="commission_month_year" class="form-control" value="" required>
                        </div>

                        @endif
                        <div class="col-md-12 form-group">
                            <label>Commission Type</label>
                            <select class="form-control" name="commission_type" id="commission_type" required>
                                <option value="">Select-A-Commission-Type</option>
                                <option value="Sales-Incentives">Seles/Incentives</option>
                                <option value="Performance-Bonus">Performance Bonus</option>
                                <option value="Project-Bonus">Project Bonus</option>
                                <option value="Other-Commission">Other Commission</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Title</label>
                            <input type="text" name="commission_title" id="commission_title" class="form-control"
                                value="" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Amount</label>
                            <input type="text" name="commission_amount" id="commission_amount" class="form-control"
                                value="" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Description</label>
                            <textarea name="commission_desc" class="form-control" cols="20" rows="8"
                                id="commission_desc" required></textarea>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
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





            //value retriving and opening the edit modal starts

            $('.editModal').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: 'employee-commission-by-id',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxModelTitle').html("Edit");
                        $('#edit-modal').modal('show');
                        $('#id').val(res.id);
                        $('#commission_month_year').val(res.commission_month_year);
                        $('#commission_type').val(res.commission_type);
                        $('#commission_title').val(res.commission_title);
                        $('#commission_amount').val(res.commission_amount);
                        $('#commission_desc').val(res.commission_desc);
                    }
                });
            });

            //value retriving and opening the edit modal ends

            // edit form submission starts

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#error-message').text('');

                $.ajax({
                    type: 'POST',
                    url: `/update-employee-commission`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        toastr.success(response.success, 'Data successfully updated!!');
                        setTimeout(function() {
                            window.location.href = '/employee-commission';
                        }, 2000)
                    },
                    error: function(response) {
                        toastr.error(response.error, 'Please Entry Valid Data!!');

                        // console.log(response);
                        //     $('#error-message').text(response.responseJSON.errors.file);
                    }
                });
            });

            // edit form submission ends








        });
</script>
@endsection