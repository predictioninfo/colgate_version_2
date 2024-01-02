<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
            border: 1px solid black;
        }

        table th {
            background-color: #fbc403;
            color: #363636;
            border: 1px solid black;
        }
    </style>

</head>
<?php
 use App\Models\Company;
 $company_names = Company::where('id',Auth::user()->com_id)->first(['company_name']);

?>

<body>
    <table id="user-table" class="table table-bordered table-hover table-striped"
        style="margin-left:-10%;margin-right:-10%;">
        <thead>
            <tr style="border: 2px solid black;">
                <th colspan="7"
                    style="background-color:#acbb23; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    EMPLOYEE
                    BASIC INFORMATION
                </th>
                <th colspan="7"
                    style="background-color:#2c793e; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    WORKING
                    HOUR ATTENDANCE AND
                    OT
                    INFORMATION</th>
                <th colspan="2"
                    style="background-color:#a8a24d; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    Salary
                    Information</th>
                <th colspan="7"
                    style="background-color:#ffee02; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    ALLOWANCE
                    INFORMATION</th>
                <th colspan="5"
                    style="background-color:#2c793e; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    Deductions
                </th>
                <th
                    style="background-color:#eb0d20; border: 1px solid black;text-align:center;font-weight:bold;font-size:12px;">
                    Actual
                    payout</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;"></th>
            </tr>
            <tr>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Employee ID</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Name</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Depatment</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Designation</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Location</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Joining Date</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Tenure (In Days)</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Number of Present days</th>
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
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Overnight Allowance/Other
                    Variables</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">OT Allowance as per New salary
                </th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">OT Arrear</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Snacks Allowance</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total Earning as per new salary
                </th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Deduction for Unauthorized leave
                </th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Other Deduction</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Total Deduction as per new
                    salary</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Other Arear</th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Net Payable as per New salary
                </th>
                <th style="border: 1px solid black;text-align:center;font-weight:bold;">Remarks</th>
            </tr>
        </thead>

        <tbody>


            @foreach($data['payment_histories'] as $payment_histories_value)

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
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->company_assigned_id
                    ?? null}}</td>
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->first_name."
                    ".$payment_histories_value->last_name}}</td>
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->department_name}}
                </td>
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->designation_name}}
                </td>
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->region_name ?? null}}
                </td>
                <td style="text-align:center;border: 1px solid black;">{{$payment_histories_value->joining_date ??
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
                    {{$payment_histories_value->customize_pay_slip_net_salary}}</td>
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
                <td style="text-align:center;border: 1px solid black;">Remarks</td>

            </tr>
            @php
            $total = 0;
            $total += $payment_histories_value->customize_pay_slip_net_salary_payable;
            @endphp
            @endforeach

            <tr>
                <td colspan="27"></td>
                <td style="text-align:center;border: 3px solid black;">
                    Total
                </td>
                <td style="text-align:center;border: 3px solid black;">
                    {{ $total ?? 0}}
                </td>
                <td></td>

            </tr>

        </tbody>

    </table>
</body>

</html>