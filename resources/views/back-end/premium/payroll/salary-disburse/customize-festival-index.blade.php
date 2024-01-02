@extends('back-end.premium.layout.premium-main')

@section('content')
<?php
use App\Models\Role;

?>
<section class="main-contant-section">

    <div class=" mb-3">

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

        @if(Role::where('id',Auth::user()->role_id)->where('roles_admin_status','Yes')->where('roles_is_active',1)->exists())
        <div class="attendance-search">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title text-center"> {{__('Festival Bounus Disburse')}} </h3>
                </div>
            </div>
        </div>
        @endif
        <div class="content-box">
            <form method="post" action="{{route('customize-festival-search-salary-disburses')}}"
                class="container-fluid">
                @csrf
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>{{__('Bank Name')}} *</label>
                        <select name="bank_id" class="form-control" required>
                            <option value=""> Choose a bank name</option>
                            @foreach($bank_accounts as $bank_account)
                            <option value="{{ $bank_account->id }}"> {{ $bank_account->company_bank_account_name ??
                                null}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{__('Bank Type')}} *</label>
                        <select name="bank_type" class="form-control" required>
                            <option value=""> Choose a bank type</option>
                            <option value="Core Bank"> Core Banking</option>
                            <option value="Mobile Bank"> Mobile Banking</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>{{__('Department')}} <span style="font-size:10px;">(Not Mandatory)</span></label>
                        <select name="department_id" class="form-control">
                            <option value="">Choose an Option</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name ?? null }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
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
                    <div class="col-md-3 form-group">
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
                    <div class="col-md-3 ">
                        <div class="form-group pt-4 mt-1">
                            {{-- <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                {{__('Search')}}
                            </button> --}}
                            <input type="submit" name="search" class="btn btn-grad" value="{{__('Search')}}" />
                            <input type="submit" name="exeldownload" class="btn btn-grad"
                                value="{{__('Bank Advise')}}" />
                            <input type="submit" name="disburse_reqest" class="btn btn-grad"
                                value="{{__('Disburse Report Request ')}}" />
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="user-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Bounus Amount</th>
                            <th>Tax</th>
                            <th>Net Payment</th>
                            <th>Payment Date</th>
                            <th>Bank Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($payment_histories as $payment_historiy)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $payment_historiy->first_name.' '.$payment_historiy->last_name}}</td>
                            <td>{{ $payment_historiy->company_assigned_id }}</td>
                            <td>{{ $payment_historiy->department_name ?? null }}</td>
                            <td>{{ $payment_historiy->designation_name ?? null }}</td>
                            <td>{{ number_format((float)$payment_historiy->festival_payment_amount , 0, '.', '')}} </td>
                            <td>{{ number_format((float)$payment_historiy->festival_payment_tax_deduction , 0, '.',
                                '')}} </td>
                            <td>{{ number_format((float)$payment_historiy->festival_payment_net_bonus , 0, '.', '')}}
                            </td>
                            <td>{{ $payment_historiy->festival_payment_customize_date ?? null }} </td>
                            <td>{{ $payment_historiy->bank_account_number }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
</section>





<script type="text/javascript">
    $(document).ready( function () {

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





                $('#department_id').on('change', function() {
                    var departmentID = $(this).val();
                    if(departmentID) {
                        $.ajax({
                            url: '/get-designation/'+departmentID,
                            type: "GET",
                            data : {"_token":"{{ csrf_token() }}"},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data){
                                    $('#designation_id').empty();
                                    $('#designation_id').append('<option hidden>Choose a Designation</option>');
                                    $.each(data, function(key, designations){
                                        $('select[name="designation_id"]').append('<option value="'+ key +'">' + designations.designation_name+ '</option>');
                                    });
                                }else{
                                    $('#designation_id').empty();
                                }
                            }
                        });
                    }else{
                        $('#designation_id').empty();
                    }
                });





                $('#designation_id').on('change', function() {
                    var designationID = $(this).val();
                    console.log(designationID);
                    if(designationID) {
                        $.ajax({
                            url: '/get-employee/'+designationID,
                            type: "GET",
                            data : {"_token":"{{ csrf_token() }}"},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data){
                                    $('#employee_id').empty();
                                    $('#employee_id').append('<option hidden>Choose Employee</option>');
                                    $.each(data, function(key, employees){
                                        $('select[name="employee_id"]').append('<option value="'+ key +'">' + employees.first_name+ '</option>');
                                    });
                                }else{
                                    $('#employee_id').empty();
                                }
                            }
                        });
                    }else{
                        $('#employee_id').empty();
                    }
                });







   });


</script>
@endsection