<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtherDeduction;
use App\Models\OtherVariableOrOtherOverNightAllowance;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OtherDeductionController extends Controller
{
  public function index(){

    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    $other_deductions = OtherDeduction::where('other_deduction_com_id', Auth::user()->com_id)->get();

    return view('back-end.premium.customize-payroll-setting.other-deduction.index',compact('customize_months','employees','other_deductions'));
    }

    public function addOtherDeduction (Request $request){

    $other_deduction = new OtherDeduction();

    $other_deduction->other_deduction_com_id = Auth::user()->com_id;
    $other_deduction->other_deduction_emp_id = $request->employee_id;
    $other_deduction->other_deduction_purpuse = $request->deduction_purpose;
    $other_deduction->other_deduction_amount = $request->amount;
    if($request->amount_month){
     $other_deduction->other_deduction_month_year = $request->amount_month;
    }
    $other_deduction->customize_other_deduction_month = $request->month;
    $other_deduction->customize_other_deduction_year = $request->year;
    $other_deduction->save();
    return back()->with('message','Deduction Added Succesfully.');
    }

    public function editOtherDeduction(Request $request,$id){

    $other_deduction = OtherDeduction::where('id',$id)->first();

    $other_deduction->other_deduction_com_id = Auth::user()->com_id;
    $other_deduction->other_deduction_emp_id = $request->employee_id;
    $other_deduction->other_deduction_purpuse = $request->deduction_purpose;
    $other_deduction->other_deduction_amount = $request->amount;
    if($request->amount_month){
     $other_deduction->other_deduction_month_year = $request->amount_month;
    }
    $other_deduction->customize_other_deduction_month = $request->month;
    $other_deduction->customize_other_deduction_year = $request->year;
    $other_deduction->save();

    return back()->with('message','Deduction Updated Succesfully.');
    }

   public function deleteOtherDeduction($id){

    OtherDeduction::where('id',$id)->delete();

     return back()->with('message','Deduction Deleted Succesfully.');
    }
}