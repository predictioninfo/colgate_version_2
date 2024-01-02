<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\Incentive;
use App\Models\Prorata;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class IncentiveController extends Controller
{
    public function index(){
        $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id','first_name','last_name','profile_photo','company_assigned_id']);
        $incentives = Incentive::where('incentive_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.customize-payroll-setting.incentive.index',compact('customize_months','employees','incentives'));
    }


    public function addIncentive(Request $request){

        $incentive = new Incentive();

        $incentive->incentive_com_id = Auth::user()->com_id ;
        $incentive->incentive_emp_id = $request->employee_id;
        $incentive->incentive_amount = $request->incentive_amount;

        if($request->incentive_amount_month){
        $incentive->incentive_month_year = $request->incentive_amount_month;
        }

        $incentive->customize_incentive_month = $request->month;
        $incentive->customize_incentive_year = $request->year;
        $incentive->save();
        return back()->with('message','Incentive added succesfully.');
    }

    public function editIncentive(Request $request,$id){

    $incentive = Incentive::where('id',$id)->first();

    $incentive->incentive_com_id = Auth::user()->com_id ;
    $incentive->incentive_emp_id = $request->employee_id;
    $incentive->incentive_amount = $request->incentive_amount;

    if($request->incentive_amount_month){
     $incentive->incentive_month_year = $request->incentive_amount_month;
    }

    $incentive->customize_incentive_month = $request->month;
    $incentive->customize_incentive_year = $request->year;
    $incentive->save();

    return back()->with('message','Incentive updated succesfully.');
    }

   public function deleteIncentive($id){

    $prorata = Incentive::where('id',$id)->delete();

     return back()->with('message','Incentive Deleted Succesfully.');
    }
}
