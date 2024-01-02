<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtherDeduction;
use App\Models\OverTimeHour;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OverTimeHourController extends Controller
{
    public function index(){
    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();
    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);
    $over_time_hour = OverTimeHour::where('over_time_hour_com_id', Auth::user()->com_id)->orderBy('id','desc')->get();
    return view('back-end.premium.customize-payroll-setting.over-time-hour.index',get_defined_vars());
    }


    public function add(Request $request){

        if(OverTimeHour::where('over_time_hour_emp_id',$request->employee_id)->where('customize_over_time_hour_month', $request->month)->where('customize_over_time_hour_year',$request->year)->exists()){

         return back()->with('existmessage','Over Time Hour Already Added This Month.');

        }else{
            $ot_hour = new OverTimeHour();
            $ot_hour->over_time_hour_com_id = Auth::user()->com_id;
            $ot_hour->over_time_hour_emp_id = $request->employee_id;
            $ot_hour->total_over_time_hour = $request->ot_hours;
            $ot_hour->working_hour = $request->working_hour;
            if($request->amount_month){
            $ot_hour->over_time_hour_mont_year = $request->amount_month;
            }
            $ot_hour->customize_over_time_hour_month = $request->month;
            $ot_hour->customize_over_time_hour_year = $request->year;
            $ot_hour->save();
        }
        return back()->with('message','Total work Hour Added Succesfully.');
    }

    public function edit(Request $request,$id){

            $ot_hour = OverTimeHour::where('id',$id)->first();
            $ot_hour->over_time_hour_com_id = Auth::user()->com_id;
            $ot_hour->over_time_hour_emp_id = $request->employee_id;
            $ot_hour->total_over_time_hour = $request->ot_hours;
            $ot_hour->working_hour = $request->working_hour;
            if($request->amount_month){
            $ot_hour->over_time_hour_mont_year = $request->amount_month;
            }
            $ot_hour->customize_over_time_hour_month = $request->month;
            $ot_hour->customize_over_time_hour_year = $request->year;
            $ot_hour->save();

        return back()->with('message','Over Time Hour Edited Succesfully.');
    }

    public function delete($id){

    OverTimeHour::where('id',$id)->delete();

     return back()->with('message','Over Time Hour Deleted Succesfully.');
    }
}
