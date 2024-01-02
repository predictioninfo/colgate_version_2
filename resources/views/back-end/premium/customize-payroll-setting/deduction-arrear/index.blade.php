@extends('back-end.premium.layout.premium-main')

@section('content')
<section>
    @php
    use App\Models\Package;
    $permission = "3.28";
    @endphp
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
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center">{{ 'Other Arrear' }} {{ __(' List') }} </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#addDepartmentModal"><span
                                    class="icon icon-plus"> </span>Add</a></li>
                    </ol>
                </div>
            </div>

            <div id="addDepartmentModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post" action="{{ route('add-deductionarrears') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <input type="hidden" name="id" value="">
                                    <div class="col-md-12 form-group">

                                        <label>{{ 'Employee Name' }}*</label>

                                        <select name="employee_id" id="employee_id"
                                            class="form-control selectpicker employee" data-live-search="true"
                                            data-live-search-style="begins" data-dependent="employee_id"
                                            title="{{ __('Selecting  name') }}..." required>
                                            @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->company_assigned_id }}-{{
                                                $employee->first_name.' '.$employee->last_name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ 'Arrear Purpose' }} *</label>
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="text" name="arrear_deduction_purpose" value="" required
                                                class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ 'Add Arrear Deduction' }} *</label>
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="number" name="amount" value="" required class="form-control"
                                                placeholder="Amount">
                                        </div>
                                    </div>

                                    @if (Package::where('id', '=',
                                    Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["' . $permission
                                    .
                                    '"]\')')->exists())

                                    <div class="col-md-6 form-group">
                                        <label>{{__('Month')}} </label>
                                        <select name="month" class="form-control " title='Month' id="month" required>
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
                                        <select name="year" class="form-control " title='Year' id="year" required>
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
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <label>{{ 'Month Year' }} *</label>
                                            <div class="input-group-prepend">

                                            </div>
                                            <input type="month" name="amount_month" value="" required
                                                class="form-control">
                                        </div>
                                    </div>
                                    @endif

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
            <div class="content-box">

                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">

                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Employee ID') }}</th>
                                <th>{{ __('Deduction Purpose') }}</th>
                                <th>{{ __('Deduction Amount') }}</th>
                                <th>{{ __('Month') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($deduction_arrears as $other_deduction)
                            <tr>

                                <td>{{ $i++ }}</td>

                                <td>{{ $other_deduction->userDeductionArrear->first_name.'
                                    '.$other_deduction->userDeductionArrear->last_name }}
                                </td>
                                <td>{{ $other_deduction->userDeductionArrear->company_assigned_id }}</td>
                                <td>{{ $other_deduction->other_deduction_arrear_purpose ?? null}}</td>
                                <td>{{ $other_deduction->other_deduction_arrear_amount ?? null}}</td>
                                @if (Package::where('id', '=',
                                Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["' . $permission
                                .
                                '"]\')')->exists())
                                <td>{{$other_deduction->customize_other_deduction_arrear_month}}</td>
                                <td>{{$other_deduction->customize_other_deduction_arrear_year}}</td>
                                @else
                                <td>{{date('F',
                                    strtotime($other_deduction->other_deduction_arrear_month_year))}}
                                </td>
                                <td>{{date('Y',
                                    strtotime($other_deduction->other_deduction_arrear_month_year))}}
                                </td>
                                @endif
                                <td>
                                    <a href="#" id="edit-post" class="btn edit" data-toggle="modal"
                                        data-target="#EditModal{{ $other_deduction->id }}" data-id=""
                                        data-toggle="tooltip" title=" Edit " data-original-title="Edit"> <i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <a href="{{ route('delete-otherarrears', ['id' => $other_deduction->id]) }}"
                                        class="btn btn-danger delete-post" data-toggle="tooltip" title=" Delete "
                                        data-original-title="Delete"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>

                                </td>

                            </tr>

                            <div id="EditModal{{ $other_deduction->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 id="exampleModalLabel" class="modal-title">{{ _('Edit') }}
                                            </h5>
                                            <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                                class="close"><i class="dripicons-cross"></i></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{ route('edit-otherarrears',['id' => $other_deduction->id]) }}"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $other_deduction->id }}">

                                                    <div class="col-md-12 form-group">
                                                        <label>{{ 'Employee Name' }}*</label>
                                                        <select name="employee_id" id="employee_id_edit"
                                                            class="form-control" data-live-search="true"
                                                            data-live-search-style="begins"
                                                            data-dependent="employee_id_edit"
                                                            title="{{ __('Selecting  name') }}...">
                                                            @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}" {{ $employee->id == $other_deduction->other_deduction_arrear_emp_id ? 'selected' : '' }}>{{
                                                                $employee->first_name.'
                                                                '.$employee->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ 'Deduction Purpose' }} *</label>
                                                            <div class="input-group-prepend">

                                                            </div>
                                                            <input type="text" name="arrear_deduction_purpose" value="{{ $other_deduction->other_deduction_arrear_purpose }}"
                                                                required class="form-control" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ 'Deduction Amount' }} *</label>
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="number" name="amount" required
                                                              value="{{ $other_deduction->other_deduction_arrear_amount }}"  class="form-control">
                                                        </div>
                                                    </div>
                                                    @if (Package::where('id', '=',
                                                    Auth::user()->com_pack)->whereRaw('json_contains(package_module,\'["'
                                                    . $permission
                                                    .
                                                    '"]\')')->exists())

                                                    <div class="col-md-6 form-group">
                                                        <label>{{__('Month')}} </label>
                                                        <select name="month" class="form-control " title='Month'
                                                            id="month" required>
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
                                                        <select name="year" class="form-control " title='Year' id="year"
                                                            required>
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
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <label>{{ 'Month Year' }} *</label>
                                                            <div class="input-group-prepend">

                                                            </div>
                                                            <input type="month" name="amount_month"
                                                                value="{{ $other_deduction->other_deduction_month_year }}"
                                                                required class="form-control">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-sm-12 mt-4">

                                                        <input type="submit" name="action_button" class="btn btn-grad "
                                                            value="{{ __('Edit') }}" />

                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>



        </div>
    </section>

</section>



<script type="text/javascript">
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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