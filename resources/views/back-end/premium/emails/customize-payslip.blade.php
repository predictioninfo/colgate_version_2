<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid black;
            }

            table td {
                line-height: 25px;
                padding-left: 15px;
            }

            table th {
                background-color: #fbc403;
                color: #363636;
            }
        </style>

    </head>

<body>
    <table table-border="1">

        <tr height="100px" style="background-color:#363636;text-align:center;font-size:24px; font-weight:600;">
            <td colspan='4' style="color:white;">@foreach($company_name as
                $company_name_value){{$company_name_value}}@endforeach</td>
        </tr>
        <tr>
            <th>ID NO:</th>
            <td>@foreach($stuff_id as $stuff_id_value){{$stuff_id_value}}@endforeach</td>
            <th>Name</th>
            <td>
                <?php foreach($employee_name as $employee_name_value){ echo $employee_name_value;} ?>
            </td>
        </tr>

         <!------6 row---->
         <tr>
            <th>Department</th>
            <td>@foreach($department_name as $department_name_value){{$department_name_value}}@endforeach</td>
            <th>Designation</th>
            <td>@foreach($designation_name as $designation_name_value){{$designation_name_value}}@endforeach</td>
        </tr>

        <!-----2 row--->
        <tr>
            <th>Bank</th>
            <td>@foreach($bank_name as $bank_name_value){{$bank_name_value}}@endforeach</td>
            <th>Bank A/C No.</th>
            <td>@foreach($bank_account_number as $bank_account_number_value){{$bank_account_number_value}}@endforeach
            </td>
        </tr>

        <tr>
            <th>Salary Month</th>
            <td>@foreach($salary_month as $salary_month){{$salary_month}}@endforeach</td>
            <th>Payment Date</th>
            <td>@foreach($payment_date as $payment_date){{$payment_date}}@endforeach</td>
        </tr>

        <!------4 row---->
        <tr>
            <th>Salary Type</th>
            <td>@foreach($salary_type as $salary_type_value){{$salary_types = $salary_type_value}}@endforeach</td>
            <th>Working Days</th>
            <td>@foreach($pay_slip_present_days as $pay_slip_present_days_value){{$pay_slip_present_days_value}}@endforeach</td>
        </tr>
        <!------5 row---->
        <tr>
            <th>Working Hour</th>
            <td>@foreach($working_hour as $working_hour_value){{$working_hour_value}}@endforeach</td>
            <th>Total OT Hour</th>
            <td>@foreach($total_ot_hour as $total_ot_hour_value){{$total_ot_hour_value}}@endforeach</td>
        </tr>

        <tr>
            <th>Total Working Hour</th>
            <td>@foreach($total_working_hour as $total_working_hour_value){{$total_working_hour_value}}@endforeach</td>
            <th>OT Per Hour Rate</th>
            <td>@foreach($customize_ot_per_hour_rate as $customize_ot_per_hour_rate_value)
                {{round($customize_ot_per_hour_rate_value)}}@endforeach</td>

        </tr>

        <tr>
            <th>DOJ</th>
            <td>@foreach($date_of_joining as $date_of_joining_value){{$date_of_joinings = $date_of_joining_value}}@endforeach</td>
            <th></th>

        </tr>

    </table>
    <tr></tr>

    <br />

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Earnings</th>
            <th>Amount</th>
            <th>Deductions</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Gross Salary</td>
            <td>@foreach($gross as $gross_value){{$gross_value}}@endforeach</td>

            <td>Other Deduction</td>
            <td>@foreach($pay_slip_other_deduction as $pay_slip_other_deduction_value){{$pay_slip_other_deduction_value}}@endforeach</td>

        </tr>
        <tr>
            <td>Basic Salary</td>
            <td>@foreach($basic as $basic_value){{$basic_value}}@endforeach</td>

            <td>Other Arear</td>
            <td>@foreach($pay_slip_other_arrear_deduction as $pay_slip_other_arrear_deduction_value){{$pay_slip_other_arrear_deduction_value}}@endforeach</td>
        </tr>
        <tr>
            <td>Festival Bonus</td>
            <td>@foreach($festival_bonus as $festival_bonus_value){{$festival_bonus_value}}@endforeach</td>
            <td>Loan</td>
            <td>@foreach($loans as $loans_value){{$loans_value}}@endforeach</td>
        </tr>
        <tr>
            <td> Overnight Allowance/Other Variables </td>
            <td>@foreach($pay_slip_ot_variable as $pay_slip_ot_variable_value){{$pay_slip_ot_variable_value}}@endforeach</td>
            <td>Unauthorised Leave</td>
            <td>@foreach( $pay_slip_deduction_for_unauthorised_leave as  $pay_slip_deduction_for_unauthorised_leave_value){{$pay_slip_deduction_for_unauthorised_leave_value}}@endforeach</td>

         </tr>
        <tr>
            <td>Salary Prorata</td>
            <td>@foreach($pay_slip_prorata as $pay_slip_prorata_value){{round($pay_slip_prorata_value)}}@endforeach</td>

         </tr>
        <tr>
            <td> Overnight Arrear </td>
             <td>@foreach($pay_slip_ot_arrear as $pay_slip_ot_arrear_value){{round($pay_slip_ot_arrear_value)}}@endforeach</td>
         </tr>
        <tr>
            <td>OT Allowance as per New salary (2023-24)</td>
            <td>@foreach($over_time_allowance as $over_time_allowance_value){{round($over_time_allowance_value)}}@endforeach</td>
         </tr>
        <tr>
            <td>Incentive</td>
            <td>@foreach($pay_slip_incentive as $pay_slip_incentive_value){{round($pay_slip_incentive_value)}}@endforeach</td>
         </tr>

        <tr>
            <td>Snacks Allowance</td>
            <td>@foreach($pay_slip_snacks_allowance as
                $pay_slip_snacks_allowance_value){{round($pay_slip_snacks_allowance_value)}}@endforeach
            </td>
        </tr>

        <tr>

            @if($salary_types == "Monthly")

            <th>Gross Earnings</th>
            <td>Tk.@foreach($gross_earning as $gross_earning_value){{round($gross_earning_value)}}@endforeach</td>
            @else
            <th>Gross Earnings</th>
            <td>Tk.@foreach($net_salary as $net_salary_value){{round($net_salary_value)}}@endforeach</td>
            @endif

            <th>Gross Deductions</th>
            <td>Tk.@foreach($gross_deduction as $gross_deduction_value){{round($gross_deduction_value)}}@endforeach</td>
        </tr>

        <tr>
            <td></td>
            <td><strong>NET PAY</strong></td>
            <td>Tk.@foreach($net_salary as $net_salary_value){{round($net_salary_value)}}@endforeach</td>
            <td></td>
        </tr>

    </table>
</body>

</html>
