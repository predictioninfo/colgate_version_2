<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtArrear;
use App\Models\PerDaySnackAllowance;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PerDaySnackAllowanceController extends Controller
{
    public function index(){

    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    $snack_allowances = PerDaySnackAllowance::where('per_day_snack_allowance_com_id', Auth::user()->com_id)->get();

    return view('back-end.premium.customize-payroll-setting.snack-allowances.index',compact('customize_months','employees','snack_allowances'));
    }
    public function addSnackAllowance(Request $request){
    if (PerDaySnackAllowance::where('per_day_snack_allowance_emp_id', '=',$request->employee_id)->where('per_day_snack_allowance_com_id',Auth::user()->com_id)->exists()){

    $snack_allowance = PerDaySnackAllowance::where('per_day_snack_allowance_emp_id',$request->employee_id)->first();
    $snack_allowance->per_day_snack_allowance_com_id = Auth::user()->com_id;
    $snack_allowance->per_day_snack_allowance_emp_id = $request->employee_id;
    $snack_allowance->per_day_snack_allowance_amount = $request->snack_allowance;
    $snack_allowance->save();
    return back()->with('message','Snack Allowance Updated Succesfully.');

    }else{

    $snack_allowance = new PerDaySnackAllowance();
    $snack_allowance->per_day_snack_allowance_com_id = Auth::user()->com_id;
    $snack_allowance->per_day_snack_allowance_emp_id = $request->employee_id;
    $snack_allowance->per_day_snack_allowance_amount = $request->snack_allowance;
    $snack_allowance->save();
    return back()->with('message','Snack Allowance Added Succesfully.');

    }




    }

    public function editSnackAllowance(Request $request,$id){

    $snack_allowance = PerDaySnackAllowance::where('id',$id)->first();

    $snack_allowance->per_day_snack_allowance_com_id = Auth::user()->com_id;
    $snack_allowance->per_day_snack_allowance_emp_id = $request->employee_id;
    $snack_allowance->per_day_snack_allowance_amount = $request->snack_allowance;
    $snack_allowance->save();

    return back()->with('message','Snack Allowance Updated Succesfully.');
    }

   public function deleteSnackAllowance($id){

     PerDaySnackAllowance::where('id',$id)->delete();

     return back()->with('message','Snack Allowance Deleted Succesfully.');
    }
}