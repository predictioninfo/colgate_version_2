<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomizeMonthName;
use App\Models\DateSetting;
use App\Models\Permission;
use Auth;
use DB;

class CustomizeMonthNameController extends Controller
{
    public  function monthConfigIndex()
    {
        $customize_sub_module_tweenty_eight_add = "3.28.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_tweenty_eight_edit = "3.28.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_tweenty_eight_delete = "3.28.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $customize_months = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->orderBy('start_month', 'ASC')->get();
        return view('back-end.premium.customize.customize-month.index', get_defined_vars());
    }
    public function addMonthConfigIndex(Request $request)
    {
        $dates = DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];


        $start_month_name = $monthNames[$request->start_month];

        if ($request->start_month != 10 && $request->start_month != 11 && $request->start_month != 12) {
            $start_month =  '0' . $request->start_month;
        } else {
            $start_month =  $request->start_month;
        }
        if ($request->next_month != 10 && $request->next_month != 11 && $request->next_month != 12) {
            $next_month =  '0' . $request->next_month;
        } else {
            $next_month =  $request->next_month;
        }
        if (CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', $start_month)->where('next_month', $next_month)->exists()) {
            return back()->with('message', 'Months Already Exists!');
        } else {
            $customize_month = new CustomizeMonthName();
            $customize_month->customize_month_names_com_id = Auth::user()->com_id;

            if ($request->customize_month_name) {
                $customize_month->customize_month_name = $request->customize_month_name;
            } else {
                $customize_month->customize_month_name = $start_month_name . ' ' . $request->next_month_name;
            }

            if ($request->start_month != 10 && $request->start_month != 11 && $request->start_month != 12) {
                $customize_month->start_month =  '0' . $request->start_month;
            } else {
                $customize_month->start_month =  $request->start_month;
            }
            if ($request->next_month != 10 && $request->next_month != 11 && $request->next_month != 12) {
                $customize_month->next_month =  '0' . $request->next_month;
            } else {
                $customize_month->next_month =  $request->next_month;
            }
            $customize_month->start_date = $dates->date_settings_start_date;
            $customize_month->end_date = $dates->date_settings_end_date;

            $customize_month->save();

            return back()->with('message', 'Months Added Successfully');
        }
    }
    public function editMonthConfigIndex(Request $request)
    {
        $update_month_name = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('id', $request->id)->first();
        return response()->json($update_month_name);
    }
    public function updateMonthConfigIndex(Request $request)
    {
        try {
            $update_month_name = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->find($request->id);
            $update_month_name->customize_month_name = $request->customize_month_name_update;
            $update_month_name->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function deleteMonthConfigIndex($id)
    {
        DB::beginTransaction();
        try {
            CustomizeMonthName::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }
}
