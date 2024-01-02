<?php

namespace App\Http\Controllers;

use App\Models\DateSetting;
use App\Models\CustomizeMonthName;
use Illuminate\Http\Request;
use Auth;

class DateSettingController extends Controller
{
    public function index()
    {
        $date_settings = DateSetting::where('date_settings_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.date-setting.index', compact('date_settings'));
    }

    public function add(Request $request)
    {

        if (DateSetting::where('date_settings_com_id', Auth::user()->com_id)->exists()) {

            $date_setting = DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();
            $date_setting->date_settings_com_id = Auth::user()->com_id;
            $date_setting->date_settings_start_date = $request->start_date;
            $date_setting->date_settings_end_date = $request->end_date;
            $date_setting->save();

            // Update the start_date and end_date for all CustomizeMonthName records
            CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)
                ->update([
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]);



            return back()->with('message', 'Date Setting Updated Sucsesfully');
        } else {

            $date_setting = new DateSetting();
            $date_setting->date_settings_com_id = Auth::user()->com_id;
            $date_setting->date_settings_start_date = $request->start_date;
            $date_setting->date_settings_end_date = $request->end_date;
            $date_setting->save();

            return back()->with('message', 'Date Setting Added Sucsesfully');
        }
    }
}
