<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\OtArrear;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class OtArrearController extends Controller
{
    public function index(){

    $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();

    $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);

    $ot_arreares = OtArrear::where('ot_arrear_com_id', Auth::user()->com_id)->get();

    return view('back-end.premium.customize-payroll-setting.ot-arrear.index',compact('customize_months','employees','ot_arreares'));
    }


    public function addOtArrear(Request $request){

    $ot_arrear = new OtArrear();
    $ot_arrear->ot_arrear_com_id = Auth::user()->com_id;
    $ot_arrear->ot_arrear_emp_id = $request->employee_id;
    $ot_arrear->ot_arrear_amount = $request->ot_amount;

    if($request->ot_amount_month){
     $ot_arrear->ot_arrear_month_year = $request->ot_amount_month;
    }

    $ot_arrear->customize_ot_arrear_month = $request->month;
    $ot_arrear->customize_ot_arrear_year = $request->year;
    $ot_arrear->save();
    return back()->with('message','OT Arrear Added Succesfully.');
    }

    public function editOtArrear(Request $request,$id){

    $ot_arrear = OtArrear::where('id',$id)->first();

    $ot_arrear->ot_arrear_com_id = Auth::user()->com_id;
    $ot_arrear->ot_arrear_emp_id = $request->employee_id;
    $ot_arrear->ot_arrear_amount = $request->ot_amount;

    if($request->ot_amount_month){
     $ot_arrear->ot_arrear_month_year = $request->ot_amount_month;
    }

    $ot_arrear->customize_ot_arrear_month = $request->month;
    $ot_arrear->customize_ot_arrear_year = $request->year;
    $ot_arrear->save();

    return back()->with('message','OT Arrear Updated Succesfully.');
    }

   public function deleteOtArrear($id){

     OtArrear::where('id',$id)->delete();

     return back()->with('message','OT Arrear Deleted Succesfully.');
    }
}