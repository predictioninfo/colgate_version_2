<?php
                    use App\Models\Permission;
                    use App\Models\Attendance;
                    use App\Models\Leave;
                    use App\Models\User;
                    use App\Models\Holiday;
                    use App\Models\Travel;
                    use App\Models\Role;
                    use App\Models\MonthlyAttendance;
                    use App\Models\LateTime;
                    use App\Models\CompensatoryLeave;
                    use App\Models\LatetimeConfig;
                    use App\Helpers\Helper;
                    //use DateTime;
                    $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata') );
                    $current_date = $date->format('Y-m-d');
                    //$current_time = $date->format('H:i:s');


?>

<table id="user-table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th colspan="6" rowspan="2"
                style="width: 85px; height: 50px; background-color: #dadfe6; text-align:center; vertical-align: center;">
                {{ __('Attendance Report') }}</th>
            @foreach($data['customRange'] as $key => $date)
            <th colspan="4"
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                {{ date('D', strtotime($date)) }}
            </th>
            @endforeach
        </tr>
        <tr>

            @foreach($data['customRange'] as $key => $date)


            <th colspan="4"
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">

                {{ date('Y-m-d', strtotime($date)) }}
                <?php
                    $day_find = date('D', strtotime($date));
                ?>
            </th>
            @endforeach
        </tr>
        <tr>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                SL</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Employee ID</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Employee </th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Department Name</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Designation</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                Date Of Joining</th>

            @foreach($data['customRange'] as $key => $date)

            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                Status</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                InTime</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                OutTime</th>
            <th
                style="text-align:center;vertical-align: center;background-color: #e08c47;border:2px solid rgb(19, 4, 4);">
                Work Hour</th>

            @endforeach
        </tr>

    </thead>
    <tbody>
        @php($j=1)
        @foreach ($data['attendances'] as $attendancesValue)
        <tr>
            <?php  $userData = User::where('com_id',Auth::user()->com_id)->where('company_assigned_id',$attendancesValue->company_assigned_id)->first(); ?>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{$j++}}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $attendancesValue->company_assigned_id }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $attendancesValue->first_name.' '.$attendancesValue->last_name}}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $userData->userdepartment->department_name ?? null }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{
                $userData->userdesignation->designation_name ?? null }}</td>
            <td
                style="text-align:center;vertical-align: center;background-color: #e9d9cc;border:2px solid rgb(19, 4, 4);">
                {{ $userData->joining_date
                ?? null}}</td>

            @foreach($data['customRange'] as $key => $date)
            <?php
            $day_year_month_date = date("Y-m-d", strtotime($date));
            $day_date_wise_day_name = date('D', strtotime($date))
        ?>

            <?php if(Attendance::where('employee_id','=',$attendancesValue->customize_monthly_employee_id)->whereDate('attendance_date','=',$day_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('P')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_date_wise_day_name)->exists()) { ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('W')}}</td>
            <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('H')}}</td>
            <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->customize_monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('L')}}</td>
            <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->customize_monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('T')}}</td>
            <?php }else{ ?>
            <td style="background-color: rgb(245, 227, 227);">{{__('A')}}</td>
            <?php } ?>
            <td style="background-color: rgb(245, 227, 227);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->customize_monthly_employee_id)->whereDate('attendance_date','=',$day_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_in ?? null}}
                <?php }else{ }?>
            </td>
            <td style="background-color: rgb(245, 227, 227);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->customize_monthly_employee_id)->whereDate('attendance_date','=',$day_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                {{$test->clock_out ?? null}}
                <?php }else{ }?>
            </td>
            <td style="background-color: rgb(245, 227, 227);">
                <?php if($test =Attendance::where('employee_id','=',$attendancesValue->customize_monthly_employee_id)->whereDate('attendance_date','=',$day_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                {{$test->total_work ?? null}}
                <?php }else{ }?>
            </td>
            @endforeach

        </tr>
        @endforeach
    </tbody>
</table>