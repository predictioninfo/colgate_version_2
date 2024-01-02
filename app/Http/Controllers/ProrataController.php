<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\Prorata;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProrataController extends Controller
{
    public function index()
    {
        $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'profile_photo', 'company_assigned_id']);
        $proratas = Prorata::where('prorata_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize-payroll-setting.prorata.index', compact('customize_months', 'employees', 'proratas'));
    }

    public function addProrata(Request $request)
    {
        $prorata = new Prorata();
        $prorata->prorata_com_id = Auth::user()->com_id;
        $prorata->prorata_emp_id = $request->employee_id;
        $prorata->prorata_amount = $request->prorata_amount;
        if ($request->prorata_amount_month) {
            $prorata->prorata_month_year = $request->prorata_amount_month;
        }
        $prorata->customize_prorata_month = $request->month;
        $prorata->customize_prorata_year = $request->year;
        $prorata->save();
        return back()->with('message', 'Prorata added succesfully.');
    }

    public function editProrata(Request $request, $id)
    {
        $prorata = Prorata::where('id', $id)->first();
        $prorata->prorata_com_id = Auth::user()->com_id;
        $prorata->prorata_emp_id = $request->employee_id;
        $prorata->prorata_amount = $request->prorata_amount;
        if ($request->prorata_amount_month) {
            $prorata->prorata_month_year = $request->prorata_amount_month;
        }
        $prorata->customize_prorata_month = $request->month;
        $prorata->customize_prorata_year = $request->year;
        $prorata->save();

        return back()->with('message', 'Prorata updated succesfully.');
    }

    public function deleteProrata($id)
    {
        $prorata = Prorata::where('id', $id)->delete();
        return back()->with('message', 'Prorata Deleted Succesfully.');
    }
}
