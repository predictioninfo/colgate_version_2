<?php

namespace App\Http\Controllers;
use App\Models\CustomizeMonthName;
use App\Models\DateSetting;
use App\Models\SalaryIncrement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Session;
use PDF;
use DB;

class SalaryIncrementController extends Controller
{


    public function giveEmployeeIncrement(Request $request)
	{
        $validated = $request->validate([
            'employee_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'increment_date' => 'required',
        ]);


        $year = date('Y', strtotime($request->increment_date));
        $month= date('m', strtotime($request->increment_date));
        $day=  date('d', strtotime($request->increment_date));

        $currentDate = Carbon::now();  // Get the current date and time
        $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

        $previousYear =  $previousMonth->format('Y');

        $previousMonth = $previousMonth->format('m');

        $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

        if ($month == "01") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $previousYear;
                $last_month = "12";

                $startDate = $previousYear . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "01";
                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "02") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "01";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "02";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "03") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $previousYear;
                $last_month = "02";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "03";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "04") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "03";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "04";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "05") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "04";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "05";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "06") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();

            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "05";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "06";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "07") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "06";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "07";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "08") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "07";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "08";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "09") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "08";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "09";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "10") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "09";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "10";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "11") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "10";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "11";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "12") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "11";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "12";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        }

        try {
        $increment_details = User::where('id', $request->employee_id)->get(['id', 'designation_id', 'email', 'first_name', 'last_name']);

        $salary_increment = new SalaryIncrement();
        $salary_increment->salary_incre_com_id = Auth::user()->com_id;
        $salary_increment->salary_incre_emp_id = $request->employee_id;
        $salary_increment->salary_incre_dept_id = $request->department_id;
        $salary_increment->salary_incre_desig_id = $request->designation_id;
        $salary_increment->increment_amount = $request->increment_amount;
        $salary_increment->cirtificate_format_id = $request->cirtificate_format_id;
        if(User::where('id',$request->employee_id)->exists()){

            $employee_details = User::where('id',$request->employee_id)->first('gross_salary');

                   $old_gross = $salary_increment->salary_incre_old_salary = $employee_details->gross_salary;
                    $total_gross = $request->increment_amount + $old_gross;
                    $employee = User::find($request->employee_id);
                    $employee->gross_salary = $total_gross;
                    $employee->salary_increment_letter_id = $request->cirtificate_format_id;


                    $employee->save();


        }else{
            return back()->with('message','Employee Not Found');
        }

        $salary_increment->salary_incre_new_salary =   $total_gross;
        $salary_increment->salary_incre_date = $request->increment_date;
        $salary_increment->customize_salary_incre_month = $last_month;
        $salary_increment->customize_salary_incre_year = $previous_month_year;

        $salary_increment->save();

        if ($request->employee_id) {
            try {

                foreach ($increment_details as $salary_increment) {

                    $data["email"] = $salary_increment->email;
                    $data["request_receiver_name"] =   $salary_increment->first_name . ' ' .  $salary_increment->last_name;
                    $data["subject"] = "Increment Letter";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );
                    Mail::send('back-end.premium.emails.probition-salary-incre-letter', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"]);
                    });
                }

            } catch (\Exception $e) {

                return back()->with('message', 'Please Setup a valid eamil to notify employee');
            }

        }

        return back()->with('message', 'Added Successfully');
    } catch (\Exception $e) {
        return back()->with('message', 'Plese fill up all requird field.');
    }
}



    public function roleById(Request $request) {

        $where = array('id' =>$request->id);
        $roleByIds = SalaryIncrement::where($where)->first();

        return response()->json($roleByIds);
    }

    public function updateEmployeeIncrement(Request $request)
	{

        $year = date('Y', strtotime($request->increment_date));
        $month= date('m', strtotime($request->increment_date));
        $day=  date('d', strtotime($request->increment_date));

        $currentDate = Carbon::now();  // Get the current date and time
        $previousMonth = $currentDate->subMonth();  // Subtract one month from the current date

        $previousYear =  $previousMonth->format('Y');

        $previousMonth = $previousMonth->format('m');

        $date_setting =  DateSetting::where('date_settings_com_id', Auth::user()->com_id)->first();

        if ($month == "01") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 12)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $previousYear;
                $last_month = "12";

                $startDate = $previousYear . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "01";
                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "02") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 1)->first();

            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "01";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "02";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "03") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 2)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $previousYear;
                $last_month = "02";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "03";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "04") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 3)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "03";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "04";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "05") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 4)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "04";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "05";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "06") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 5)->first();

            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "05";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "06";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "07") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 6)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "06";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "07";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "08") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 7)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "07";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "08";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "09") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 8)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "08";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "09";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "10") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 9)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "09";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "10";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "11") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 10)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "10";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "11";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        } elseif ($month == "12") {
            $customize_date = CustomizeMonthName::where('customize_month_names_com_id', Auth::user()->com_id)->where('start_month', 11)->first();
            if ($customize_date->end_date >= $day) {
                $previous_month_year = $year;
                $last_month = "11";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            } else {
                $previous_month_year = $year;
                $last_month = "12";

                $startDate = $year . '-' . $customize_date->start_month . '-' . $customize_date->start_date;
                $endDate = $year . '-' . $customize_date->next_month . '-' . $customize_date->end_date;
            }
        }


        $salary_increment = SalaryIncrement::find($request->id);
        $salary_increment->salary_incre_com_id = Auth::user()->com_id;

        $salary_increment->increment_amount = $request->increment_amount;

        if(User::where('id',$request->employee_id)->exists()){

                    $employee_details = User::where('id',$request->employee_id)->first('gross_salary');
                    $old_gross = $salary_increment->salary_incre_old_salary = $employee_details->gross_salary;
                    $total_gross = $request->increment_amount + $old_gross;
                    $employee = User::find($request->employee_id);
                    $employee->gross_salary = $total_gross;
                    $employee->salary_increment_letter_id = $request->cirtificate_format_id;
                    $employee->save();


        }else{
            return back()->with('message','Employee Not Found');
        }
        $salary_increment->salary_incre_new_salary =   $total_gross;
        $salary_increment->salary_incre_date = $request->increment_date;
        $salary_increment->customize_salary_incre_month = $last_month;
        $salary_increment->customize_salary_incre_year = $previous_month_year;
        $salary_increment->cirtificate_format_id = $request->cirtificate_format_id;

        $salary_increment->save();
        return back()->with('message','Updated Successfully');
	}



    public function deleteEmployeeIncrement($id)
    {
        $salary_increment = SalaryIncrement::where('id',$id)->delete();
        return back()->with('message','Deleted Successfully');
    }
}