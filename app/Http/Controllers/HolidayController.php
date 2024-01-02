<?php

namespace App\Http\Controllers;

use App\Models\CustomizeMonthName;
use App\Models\DateSetting;
use App\Models\Holiday;
use App\Models\CompanyCalendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;

class HolidayController extends Controller
{
    public function manageWeeklyHolidayStore(Request $request)
    {
        $validated = $request->validate([
            'holiday_type' => 'required',
            'holiday_name' => 'required',
        ]);
        try {
            if ($request->holiday_name == 'Mon') {
                $holiday_numbers = 1;
            } elseif ($request->holiday_name == 'Tue') {
                $holiday_numbers = 2;
            } elseif ($request->holiday_name == 'Wed') {
                $holiday_numbers = 3;
            } elseif ($request->holiday_name == 'Thu') {
                $holiday_numbers = 4;
            } elseif ($request->holiday_name == 'Fri') {
                $holiday_numbers = 5;
            } elseif ($request->holiday_name == 'Sat') {
                $holiday_numbers = 6;
            } elseif ($request->holiday_name == 'Sun') {
                $holiday_numbers = 7;
            }

            $holiday = new Holiday();
            $holiday->holiday_com_id = Auth::user()->com_id;
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->holiday_number = $holiday_numbers;
            $holiday->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Weekly Holiday Added Successfully');
    }

    public function editWeeklyHoliday(Request $request)
    {

        $where = array('id' => $request->id);
        $holidays  = Holiday::where($where)->first();

        return response()->json($holidays);
    }

    public function updateWeeklyHoliday(Request $request)
    {
        $validated = $request->validate([
            'holiday_type' => 'required',
            'holiday_name' => 'required',
        ]);
        try {
            if ($request->holiday_name == 'Mon') {
                $holiday_numbers = 1;
            } elseif ($request->holiday_name == 'Tue') {
                $holiday_numbers = 2;
            } elseif ($request->holiday_name == 'Wed') {
                $holiday_numbers = 3;
            } elseif ($request->holiday_name == 'Thu') {
                $holiday_numbers = 4;
            } elseif ($request->holiday_name == 'Fri') {
                $holiday_numbers = 5;
            } elseif ($request->holiday_name == 'Sat') {
                $holiday_numbers = 6;
            } elseif ($request->holiday_name == 'Sun') {
                $holiday_numbers = 7;
            }

            $holiday = Holiday::find($request->id);
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->holiday_number = $holiday_numbers;
            $holiday->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Weekly Holiday Updated Successfully');
    }

    public function deleteWeeklyHoliday(Request $request)
    {
        $holidays = Holiday::where('id', $request->id)->delete();

        $success_msg = 'Deleted';

        return response()->json($success_msg);

        // return response()->json(['success' => true]);
    }

    public function manageOtherHolidayStore(Request $request)
    {
        try {

      //custom holiday start date start

        $year = date('Y', strtotime($request->start_date));
        $month = date('m', strtotime($request->start_date));
        $day = date('d', strtotime($request->start_date));
        $start_day = date('d', strtotime($request->start_date));


        $currentDate = Carbon::now();  // Get the current date and time

        $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

        $previousYear =  $previousMonth->format('Y');

        $previousMonth = $previousMonth->format('m');

        $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

        if ($month == "1") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $previousYear;
                $holiday_month_start = "12";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "01";
            }
        } elseif ($month == "2") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $previousYear;
                $holiday_month_start = "01";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "02";
            }
        } elseif ($month == "3") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $previousYear;
                $holiday_month_start = "02";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "03";
            }
        } elseif ($month == "4") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "03";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "04";
            }
        } elseif ($month == "5") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "04";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "05";
            }
        } elseif ($month == "6") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "05";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "06";
            }
        } elseif ($month == "7") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "06";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "07";
            }
        } elseif ($month == "8") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "07";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "08";
            }
        } elseif ($month == "9") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "08";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "09";
            }
        } elseif ($month == "10") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "09";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "10";
            }
        } elseif ($month == "11") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "10";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "11";
            }
        } elseif ($month == "12") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_start = $year;
                $holiday_month_start = "11";
            } else {
                $holiday_year_start = $year;
                $holiday_month_start = "12";
            }
        }

        //custom holiday start date end

        //custom holiday end date start

        $year = date('Y', strtotime($request->end_date));
        $month = date('m', strtotime($request->end_date));
        $day = date('d', strtotime($request->end_date));
        $end_day = date('d', strtotime($request->end_date));

        $currentDate = Carbon::now();  // Get the current date and time

        $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

        $previousYear =  $previousMonth->format('Y');

        $previousMonth = $previousMonth->format('m');

        $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

        if ($month == "1") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $previousYear;
                $holiday_month_end = "12";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "01";
            }
        } elseif ($month == "2") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $previousYear;
                $holiday_month_end = "01";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "02";
            }
        } elseif ($month == "3") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $previousYear;
                $holiday_month_end = "02";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "03";
            }
        } elseif ($month == "4") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "03";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "04";
            }
        } elseif ($month == "5") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "04";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "05";
            }
        } elseif ($month == "6") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "05";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "06";
            }
        } elseif ($month == "7") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "06";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "07";
            }
        } elseif ($month == "8") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "07";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "08";
            }
        } elseif ($month == "9") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "08";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "09";
            }
        } elseif ($month == "10") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "09";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "10";
            }
        } elseif ($month == "11") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "10";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "11";
            }
        } elseif ($month == "12") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
            if ($customize_date->end_date >= $day) {
                $holiday_year_end = $year;
                $holiday_month_end = "11";
            } else {
                $holiday_year_end = $year;
                $holiday_month_end = "12";
            }
        }

        //custom holiday end  date end

            function generateRandomString($length = 25)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $random_key = generateRandomString();

            $holiday = new Holiday();
            $holiday->holiday_com_id = Auth::user()->com_id;
            $holiday->holiday_unique_key = $random_key;
            $holiday->holiday_type = $request->holiday_type;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->start_date = $request->start_date;
            $holiday->end_date = $request->end_date;
            $holiday->customize_start_date = $holiday_year_start.'-'.$holiday_month_start.'-'.$start_day;
            $holiday->customize_end_date = $holiday_year_end.'-'.$holiday_month_end.'-'.$end_day;

            $holiday->customize_start_month = $holiday_month_start;
            $holiday->customize_start_year = $holiday_year_start;

            $holiday->save();

            $event = new CompanyCalendar();
            $event->company_calendar_com_id = Auth::user()->com_id;
            $event->company_calendar_unique_key = $random_key;
            $event->company_calendar_employee_all = "Yes";
            $event->calander_detail_type = "Holiday";
            $event->title = $request->holiday_name;
            $event->start = $request->start_date;
            $event->end = $request->end_date;
            $event->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check clearfully');
        }
        return back()->with('message', 'Other Holiday Added Successfully');
    }

    public function editOtherHolidayGetting(Request $request)
    {
        $where = array('id' => $request->id);
        $holidays  = Holiday::where($where)->first();
        return response()->json($holidays);
    }

    public function editCompanyOtherHoliday(Request $request)
    {
        try {

            //custom holiday start date start

                $year = date('Y', strtotime($request->start_date));
                $month = date('m', strtotime($request->start_date));
                $day = date('d', strtotime($request->start_date));
                $start_day = date('d', strtotime($request->start_date));


                $currentDate = Carbon::now();  // Get the current date and time

                $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

                $previousYear =  $previousMonth->format('Y');

                $previousMonth = $previousMonth->format('m');

                $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

                if ($month == "1") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $previousYear;
                        $holiday_month_start = "12";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "01";
                    }
                } elseif ($month == "2") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $previousYear;
                        $holiday_month_start = "01";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "02";
                    }
                } elseif ($month == "3") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $previousYear;
                        $holiday_month_start = "02";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "03";
                    }
                } elseif ($month == "4") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "03";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "04";
                    }
                } elseif ($month == "5") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "04";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "05";
                    }
                } elseif ($month == "6") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "05";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "06";
                    }
                } elseif ($month == "7") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "06";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "07";
                    }
                } elseif ($month == "8") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "07";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "08";
                    }
                } elseif ($month == "9") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "08";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "09";
                    }
                } elseif ($month == "10") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "09";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "10";
                    }
                } elseif ($month == "11") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "10";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "11";
                    }
                } elseif ($month == "12") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_start = $year;
                        $holiday_month_start = "11";
                    } else {
                        $holiday_year_start = $year;
                        $holiday_month_start = "12";
                    }
                }

                //custom holiday start date end

                //custom holiday end date start

                $year = date('Y', strtotime($request->end_date));
                $month = date('m', strtotime($request->end_date));
                $day = date('d', strtotime($request->end_date));
                $end_day = date('d', strtotime($request->end_date));

                $currentDate = Carbon::now();  // Get the current date and time

                $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

                $previousYear =  $previousMonth->format('Y');

                $previousMonth = $previousMonth->format('m');

                $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

                if ($month == "1") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $previousYear;
                        $holiday_month_end = "12";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "01";
                    }
                } elseif ($month == "2") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $previousYear;
                        $holiday_month_end = "01";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "02";
                    }
                } elseif ($month == "3") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $previousYear;
                        $holiday_month_end = "02";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "03";
                    }
                } elseif ($month == "4") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "03";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "04";
                    }
                } elseif ($month == "5") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "04";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "05";
                    }
                } elseif ($month == "6") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "05";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "06";
                    }
                } elseif ($month == "7") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "06";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "07";
                    }
                } elseif ($month == "8") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "07";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "08";
                    }
                } elseif ($month == "9") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "08";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "09";
                    }
                } elseif ($month == "10") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "09";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "10";
                    }
                } elseif ($month == "11") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "10";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "11";
                    }
                } elseif ($month == "12") {
                    $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
                    if ($customize_date->end_date >= $day) {
                        $holiday_year_end = $year;
                        $holiday_month_end = "11";
                    } else {
                        $holiday_year_end = $year;
                        $holiday_month_end = "12";
                    }
                }

                //custom holiday end  date end

            $holiday = Holiday::find($request->id);
            $holiday->holiday_name = $request->holiday_name;
            $holiday->start_date = $request->start_date;
            $holiday->end_date = $request->end_date;
            $holiday->customize_start_date = $holiday_year_start.'-'.$holiday_month_start.'-'.$start_day;
            $holiday->customize_end_date = $holiday_year_end.'-'.$holiday_month_end.'-'.$end_day;
            $holiday->customize_start_month = $holiday_month_start;
            $holiday->customize_start_year = $holiday_year_start;
            $holiday->save();


            $holiday_unique_key_array = Holiday::where('id', '=', $request->id)->get(['holiday_unique_key']);
            foreach ($holiday_unique_key_array as  $holiday_unique_key_array_value) {
                if (CompanyCalendar::where('company_calendar_unique_key', $holiday_unique_key_array_value->holiday_unique_key)->exists()) {
                    $unique_key_wise_id = CompanyCalendar::where('company_calendar_unique_key', $holiday_unique_key_array_value->holiday_unique_key)->first('id');

                    $event = CompanyCalendar::find($unique_key_wise_id->id);
                    $event->title = $request->holiday_name;
                    $event->start = $request->start_date;
                    $event->end = $request->end_date;
                    $event->save();
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Other Holiday Updated Successfully');
    }

    public function deleteOtherHoliday($id)
    {
        $unique_key_wise_id = Holiday::where('id', $id)->first('holiday_unique_key');
        $delete_company_calender = CompanyCalendar::where('company_calendar_unique_key', $unique_key_wise_id->holiday_unique_key)->delete();
        $holiday = Holiday::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
