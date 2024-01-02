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
                        <h1 class="card-title text-center"> {{ __('Festival Payments History') }} </h1>
                        <nav aria-label="breadcrumb">

                            <ol id="breadcrumb1">
                                <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                                <li><a href="#">List -Festival Payments History </a></li>
                            </ol>

                        </nav>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                action="{{route('customize-department-and-month-wise-payment-festival-histories')}}">
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
                    <br>
                    <form method="post" action="{{route('customize-month-wise-festival-salary-sheet-generates')}}">
                        @csrf
                        <div class="row" style="">
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
                            <div class="col-md-6" style="margin-top:30px;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-grad" formtarget="_blank"><i
                                            class="fa fa-search"></i>
                                        {{__('Download PDF')}}
                                    </button>
                                </div>
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
                        <th>SL</th>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                        <th>Department Name</th>
                        <th>Bank Account</th>
                        <th>Payment Date</th>
                        <th>Bounus Month</th>
                        <th>Bounus Tilte</th>
                        <th>Bounus Type</th>
                        <th>Bounus Percentage</th>
                        <th>Bounus Amount</th>
                        <th>Tax</th>
                        <th>Net Bounus Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @foreach($festival_payments as $festival_payment)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $festival_payment->festivalPaymentUser->first_name }} {{
                            $festival_payment->festivalPaymentUser->last_name }}</td>
                        <td>{{ $festival_payment->festivalPaymentUser->company_assigned_id }}</td>
                        <td>{{ $festival_payment->festivalPaymentDepartment->department_name ?? null }}</td>
                        <td>{{ $festival_payment->festivalPaymentBankAccount->bank_account_number ?? null }}</td>
                        <td>{{ $festival_payment->festival_payment_customize_date }}</td>
                        <td>{{ date('F',strtotime($festival_payment->festival_payment_customize_date))}}</td>
                        <td>{{ $festival_payment->festivalPaymentBonus->festival_bonus_title ?? null}}</td>
                        <td>{{ $festival_payment->festivalPaymentBonusConfig->festival_config_salary_type }}</td>
                        <td>{{ $festival_payment->festival_payment_percentage }}%</td>
                        <td>{{ $festival_payment->festival_payment_amount }}</td>
                        <td>{{ $festival_payment->festival_payment_tax_deduction }}</td>
                        <td>{{ $festival_payment->festival_payment_net_bonus }}</td>
                        <td>
                            <form action="{{ route('paymentFestivalDelete') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$festival_payment->id}}">
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn">Remove</button>
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