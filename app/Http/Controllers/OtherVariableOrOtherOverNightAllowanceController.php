<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtherVariableOrOtherOverNightAllowance;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OtherVariableOrOtherOverNightAllowanceController extends Controller
{
    public function index(){

    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    $otvariables = OtherVariableOrOtherOverNightAllowance::where('other_variable_or_other_over_night_allowance_com_id', Auth::user()->com_id)->get();

    return view('back-end.premium.customize-payroll-setting.ot-allowance.index',compact('customize_months','employees','otvariables'));
    }

    public function addOtAllowance(Request $request){

    $ot_variable = new OtherVariableOrOtherOverNightAllowance();

    $ot_variable->other_variable_or_other_over_night_allowance_com_id = Auth::user()->com_id;
    $ot_variable->other_variable_or_other_over_night_allowance_emp_id = $request->employee_id;
    $ot_variable->other_variable_or_other_over_night_allowance_amount = $request->ot_amount;

    if($request->ot_amount_month){
     $ot_variable->other_variable_or_other_over_night_allowance_month_year = $request->ot_amount_month;
    }

    $ot_variable->customize_other_variable_or_other_over_night_allowance_month = $request->month;
    $ot_variable->customize_other_variable_or_other_over_night_allowance_year = $request->year;
    $ot_variable->save();
    return back()->with('message','OT Variable Added Succesfully.');
    }

    public function editOtAllowance(Request $request,$id){

    $ot_variable = OtherVariableOrOtherOverNightAllowance::where('id',$id)->first();

    $ot_variable->other_variable_or_other_over_night_allowance_com_id = Auth::user()->com_id;
    $ot_variable->other_variable_or_other_over_night_allowance_emp_id = $request->employee_id;
    $ot_variable->other_variable_or_other_over_night_allowance_amount = $request->ot_amount;

    if($request->ot_amount_month){
     $ot_variable->other_variable_or_other_over_night_allowance_month_year = $request->ot_amount_month;
    }

    $ot_variable->customize_other_variable_or_other_over_night_allowance_month = $request->month;
    $ot_variable->customize_other_variable_or_other_over_night_allowance_year = $request->year;
    $ot_variable->save();

    return back()->with('message','OT Variable Updated Succesfully.');
    }

   public function deleteOtAllowance($id){

    OtherVariableOrOtherOverNightAllowance::where('id',$id)->delete();

     return back()->with('message','OT Variable Deleted Succesfully.');
    }
}
