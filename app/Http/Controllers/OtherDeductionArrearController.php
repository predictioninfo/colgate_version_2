<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtherDeduction;
use App\Models\OtherDeductionArrear;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OtherDeductionArrearController extends Controller
{
    public function index(){

    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    $deduction_arrears = OtherDeductionArrear::where('other_deduction_arrear_com_id', Auth::user()->com_id)->get();

    return view('back-end.premium.customize-payroll-setting.deduction-arrear.index',compact('customize_months','employees','deduction_arrears'));
    }

    public function addDeductionArrear (Request $request){

    $deduction_arrear = new OtherDeductionArrear();

    $deduction_arrear->other_deduction_arrear_com_id = Auth::user()->com_id;
    $deduction_arrear->other_deduction_arrear_emp_id = $request->employee_id;
    $deduction_arrear->other_deduction_arrear_purpose = $request->arrear_deduction_purpose;
    $deduction_arrear->other_deduction_arrear_amount = $request->amount;
    if($request->amount_month){
     $deduction_arrear->other_deduction_arrear_month_year = $request->amount_month;
    }
    $deduction_arrear->customize_other_deduction_arrear_month = $request->month;
    $deduction_arrear->customize_other_deduction_arrear_year = $request->year;
    $deduction_arrear->save();
    return back()->with('message','Other Arrear Added Succesfully.');
    }

    public function editDeductionArrear(Request $request,$id){

    $deduction_arrear = OtherDeductionArrear::where('id',$id)->first();

    $deduction_arrear->other_deduction_arrear_com_id = Auth::user()->com_id;
    $deduction_arrear->other_deduction_arrear_emp_id = $request->employee_id;
    $deduction_arrear->other_deduction_arrear_purpose = $request->arrear_deduction_purpose;
    $deduction_arrear->other_deduction_arrear_amount = $request->amount;
    if($request->amount_month){
     $deduction_arrear->other_deduction_arrear_month_year = $request->amount_month;
    }
    $deduction_arrear->customize_other_deduction_arrear_month = $request->month;
    $deduction_arrear->customize_other_deduction_arrear_year = $request->year;
    $deduction_arrear->save();

    return back()->with('message','Other Arrear Updated Succesfully.');
    }

   public function deleteDeductionArrear($id){

    OtherDeductionArrear::where('id',$id)->delete();

     return back()->with('message','Other Arrear Deleted Succesfully.');
    }
}