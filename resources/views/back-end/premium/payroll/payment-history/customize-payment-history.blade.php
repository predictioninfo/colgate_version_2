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
        <div class="content-box">

            <div class="card mb-4">

                <div class="card mb-0">
                    <div class="card-header with-border">
                        <h1 class="card-title text-center"> {{ __('Payments History') }} </h1>
                        <nav aria-label="breadcrumb">

                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                <li><a href="#">List - Payments History </a></li>
                            </ol>

                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('customize-payment-histories')}}">
                                @csrf
                                <div class="row align-items-end">

                                    <div class="col-md-3 form-group">
                                        <label>{{__('Department')}} *</label>
                                        <select name="payment_history_department_id" class="form-control" required>
                                            <option>Choose a Department</option>
                                            <option value="0">All Department</option>
                                            @foreach($departments as $departments_value)
                                            <option value="{{$departments_value->id}}">
                                                {{$departments_value->department_name}}</option>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                                    {{__('Search')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form method="post" action="{{route('customize-month-wise-salary-sheet-generates')}}">
                        @csrf
                        <div class="row">


                            <div class="col-md-3 form-group">
                                <label>{{__('Month ')}} </label>
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
                                    <input type="submit" name="download_pdf" class="btn btn-grad"
                                        value="{{__('Download PDF')}}" />
                                    <input type="submit" name="download_excel" class="btn btn-grad"
                                        value="{{__('Download Excel')}}" />
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- <form method="post" action="{{route('month-wise-salary-sheet-generate-exceles')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="start_date">{{__('Month')}}</label>
                                    <input class="form-control" type="month" name="month_year" required>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:30px;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-grad" formtarget="_blank"><i
                                            class="fa fa-search"></i>
                                        {{__('Download Excel')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>

        </div>

        {{--<div class="float-right">

            <form method="post" action="{{route('make-payments')}}" class="form-horizontal btn"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="monthly_attendance_row_id" value="">

                <input type="submit" name="action_button" class="btn btn-dark" value="{{__('Download PDF')}}" />
            </form>

        </div>--}}



    </div>


    <div class="content-box">

        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">SL</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Employee ID</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Name</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Depatment</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Designation</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Location</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Joining Date</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Tenure (In Days)</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Number of Present days
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Leave</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Number of Unauthorized
                            Leave/Total Absence</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Working Hour</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total OT Hour</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">OT Per Hour</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total Working Hour</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">New Gross Salary </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Basic Salary </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;"> Bonus
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Salary Prorata</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Incentive</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Overnight
                            Allowance/Other
                            Variables</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">OT Allowance as per New
                            salary
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">OT Arrear</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Snacks Allowance</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total Earning as per new
                            salary
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Deduction for
                            Unauthorized leave
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Other Deduction</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total Deduction as per
                            new
                            salary</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Other Arear</th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Net Payable as per New
                            salary
                        </th>
                        <th style="border: 1px solid black;text-align:center;font-weight:bold;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($payment_histories as $payment_histories_value)


                    <?php
                $days = floor((time() - strtotime($payment_histories_value->joining_date)) / 86400);

                $start_date = new DateTime($payment_histories_value->joining_date);
                $end_date = new DateTime();

                $interval = $start_date->diff($end_date);

                $years = $interval->y;
                $months = $interval->m;
                $day = $interval->d+1;

                $total_months = $years * 12 + $months;

            ?>
                    <tr>
                        <td style="text-align:center;border: 1px solid black;">{{$i++}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->company_assigned_id
                            ?? null}}</td>
                        <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->first_name."
                            ".$payment_histories_value->last_name}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->department_name}}
                        </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->designation_name}}
                        </td>
                        <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->region_name
                            ?? null}}
                        </td>
                        <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->joining_date
                            ??
                            null}}</td>
                        <td style="text-align:center;border: 1px solid black;">{{ $years.' '.__('Year').' '.$months.'
                            '.__('Month').' '.$day.' '.__('days')}} </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_present_days}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_leave_days}}</td>

                        <td style="text-align:center;border: 1px solid black;">{{
                            $payment_histories_value->customize_pay_slip_absence_days }}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_working_hour}}</td>

                        <td style="text-align:center;border: 1px solid black;">{{
                            $payment_histories_value->customize_pay_slip_total_over_time_hour }}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_over_time_hour_per_hour_rate}}</td>
                        <td style="text-align:center;border: 1px solid black;">{{
                            $payment_histories_value->customize_total_working_hour}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_gross_salary}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_basic_salary}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_festival_bonus}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_prorata}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_incentive}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_ot_variable}}</td>

                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_over_time_allowance}} </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_ot_arrear}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_snacks_allowance}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_net_salary}} </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->pay_slip_deduction_for_unauthorised_leave}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_other_deduction}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_total_deduction}} </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_other_arrear_deduction}}
                        </td>
                        <td style="text-align:center;border: 1px solid black;">
                            {{$payment_histories_value->customize_pay_slip_net_salary_payable}}</td>
                        <td style="text-align:center;border: 1px solid black;">
                            <form action="{{ route('customizePaymentDelete') }}" method="post"
                                enctype="multipart/form-data">
                                {{method_field('post')}}
                                @csrf
                                <input type="hidden" name="monthly_attendance_row_id"
                                    value="{{$payment_histories_value->customize_monthly_attendance_id}}">
                                <input type="hidden" name="monthly_attendanc_payment_status" value="0">
                                <input type="hidden" name="id" value="{{$payment_histories_value->id}}"
                                    class="form-check-input">
                                <button type="submit" class="btn btn-block">Remove</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

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
                      extend: 'csv',
                      text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                      exportOptions: {
                          columns: ':visible:Not(.not-exported)',
                          rows: ':visible'
                      },
                  },
                  {
                      extend: 'pdf',
                      text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
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

  } );


</script>



@endsection
