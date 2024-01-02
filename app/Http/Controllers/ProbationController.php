<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SalaryHistory;
use App\Models\ProbationRecomendetion;
use App\Models\ProbitionLetterFormats;
use App\Models\Termination;
use App\Models\Promotion;
use PDF;
use Mail;
use Mpdf\Tag\Select;

class ProbationController extends Controller
{
    public function employeeProbationIndex()
    {
        $probation_employees = User::where('employment_type', 'Probation')
            ->where('probation_status', 0)
            ->where('is_active', 1)
            ->where('com_id', Auth::user()->com_id)
            ->get();

        return view('back-end.premium.probation.review-index', get_defined_vars());
    }

    public function employeeProbationRecommendation($id)
    {
        $user = User::where('id', $id)
            ->select('id', 'department_id', 'designation_id', 'in_probation_month', 'joining_date', 'probation_expiry_date', 'gross_salary', 'report_to_parent_id')
            ->first();
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
        $notification = new Notification();
        $notification->notification_token = $random_key;
        $notification->notification_com_id = Auth::user()->com_id;
        $notification->notification_type = "Probation Recomenation";
        $notification->notification_title = "You Have A Probation Recomenation Notification";
        $notification->notification_to = $user->report_to_parent_id;
        $notification->notification_from =  Auth::user()->id;
        $notification->notification_status = "Unseen";
        $notification->save();



        $probation = new ProbationRecomendetion();
        $probation->pro_com_id = Auth::user()->com_id;
        $probation->pro_emp_id = $user->id;
        $probation->pro_dep_id = $user->department_id;
        $probation->pro_desi_id = $user->designation_id;
        $probation->pro_joining_date = $user->joining_date;
        $probation->pro_month = $user->in_probation_month;
        $probation->pro_expi_date = $user->probation_expiry_date;
        $probation->pro_old_salary = $user->gross_salary ?? '';
        $probation->status = 0;
        $probation->save();

        $probation_status = User::where('id', $id)
            ->update([
                'com_id' => Auth::user()->com_id,
                'probation_status' => 1
            ]);
        return redirect('recommendation-employee')->with('message', 'Send');
    }

    public function employeeRecommendationIndex()
    {
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $recommendations = ProbationRecomendetion::orderBy('id', 'DESC')
                ->where('termination_status', 0)
                ->get();
            $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        } else {
            $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
            $recommendations = ProbationRecomendetion::join('users', 'probation_recomendetions.pro_emp_id', '=', 'users.id')
                ->join('departments', 'probation_recomendetions.pro_dep_id', '=', 'departments.id')
                ->join('designations', 'probation_recomendetions.pro_desi_id', '=', 'designations.id')
                ->select('probation_recomendetions.*', 'users.first_name', 'users.last_name', 'users.gross_salary', 'departments.department_name', 'designations.designation_name', 'users.probation_expiry_date', 'users.in_probation_month')
                ->where('users.report_to_parent_id', '=', Auth::user()->id)
                ->where('users.is_active', '=', 1)
                ->orderBy('id', 'DESC')
                ->get();
        }
        $probation_templates = ProbitionLetterFormats::orderBy('id', 'DESC')->get();
        return view('back-end.premium.probation.recommendation', get_defined_vars());
    }

    public function employeeReviewIndex(Request $request)
    {
        if ($request->recommendation_id) {
            $id = $request->recommendation_id;
        } else {
            $id = $request->recommendation_id2;
        }

        ProbationRecomendetion::where('id', $id)
            ->update([
                'pro_com_id' => Auth::user()->com_id,
                'question_1' => $request->question_1 ?? $request->output_field1,
                'question_2' => $request->question_2 ?? $request->output_field2,
                'question_3' => $request->question_3 ?? $request->output_field3,

                'increment_salary_supervisor' => $request->increment_salary_supervisor,
                'pro_incre_salary' => $request->increment_salary_value,

                'check2supervisor' => $request->check2supervisor,
                'check4supervisor' => $request->check4supervisor,
                'enxtend_month_supervisor' => $request->enxtend_month_supervisor,
                'without_salary_supervisor' => $request->increment_without_salary_supervisor,
                'description' => $request->description ?? $request->description_field1,
                'employee_previous_designation_pro_emp_id_sup' => $request->employee_previous_designation_pro_emp_id_sup,
                'employee_previous_department_sup_id' => $request->employee_previous_department_sup_id,
                'employee_previous_designation_id_sup' => $request->employee_previous_designation_id_sup,
                'new_department_id_sup' => $request->new_department_id_sup,
                'new_designation_sup' => $request->new_designation_sup,
                'employee_previous_salary_sup' => $request->employee_previous_salary_sup,
                'new_gross_salary' => $request->new_gross_salary,
                'status' => 0,
                'supervisor_status' => 1
            ]);
        $emp_id =  ProbationRecomendetion::where('id', $id)->first('pro_emp_id');
        $user = User::where('id', $emp_id->pro_emp_id)
            ->select('id', 'department_id', 'designation_id', 'in_probation_month', 'joining_date', 'probation_expiry_date', 'gross_salary', 'report_to_parent_id')
            ->first();
        $admins = User::where('user_admin_status', 'Yes')->first('id');
        function generateRandomString1($length = 25)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $random_key = generateRandomString1();
        $notification = new Notification();
        $notification->notification_token = $random_key;
        $notification->notification_com_id = Auth::user()->com_id;
        $notification->notification_type = "Supervisor Recomenation";
        $notification->notification_title = "You Have A Recomenation Notification from Supervisor";
        $notification->notification_to = $admins->id;
        $notification->notification_from =  $user->report_to_parent_id;
        $notification->notification_status = "Unseen";
        $notification->save();


        return redirect()->back()->with('message', 'Review successfully');
    }

    public function employeeReviewShow(Request $request)
    {
        $probation_templates = ProbitionLetterFormats::orderBy('id', 'DESC')->get();
        $preview =  ProbationRecomendetion::with('recDepartment', 'recDepartmentNew', 'recDesignationNew','recDepartmentAdmin', 'recDesignationAdmin')->where('id', $request->id)->first();
        $user_department = User::where('id', $preview->pro_emp_id)
            ->with('userdepartment', 'userdesignation')
            ->select('department_id', 'designation_id')
            ->first();
        return response()->json(get_defined_vars());
    }

    public function employeeReviewUpdate(Request $request)
    {

        if ($request->increment_without_salary_admin) {
            ProbationRecomendetion::where('id', $request->id)
                ->update([
                    'pro_com_id' => Auth::user()->com_id,
                    'question_1' => $request->question_1,
                    'question_2' => $request->question_2,
                    'question_3' => $request->question_3,
                    'without_salary_admin' => $request->increment_without_salary_admin,
                    'description' => $request->description,
                    'template_id' => $request->template_id,
                    'status' => 1,
                    'termination_status' => 0,
                    'supervisor_status' => 0,
                ]);
                User::where('id', $request->pro_emp_id)
                ->update([
                    'com_id' => Auth::user()->com_id,
                    'probation_letter_format_id' => $request->template_id
                ]);
            $probation = ProbationRecomendetion::where('id', $request->id)->get();

            foreach ($probation as $probationValue) {

                $employee_details = User::where('id', $probationValue->pro_emp_id)->get();

                foreach ($employee_details as $promotion_value) {

                    $data["email"] = $promotion_value->email;
                    $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
                    $data["subject"] = "Promotion Letter";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );

                    $company_details = Company::where('id', $promotion_value->com_id)->first(['company_name', 'company_logo']);
                    $department_details = Department::where('id', $promotion_value->department_id)->first(['department_name']);
                    $designation_details = Designation::where('id', $promotion_value->designation_id)->first(['designation_name']);
                    $probation = ProbationRecomendetion::with('probationLetterFormat', 'salaryconfig')->first();
                    $probation = ProbationRecomendetion::select("*")->with([
                        'probationLetterFormat' => function ($q) {
                            $q->select('*');
                        }, 'probationLetterFormat.probitionSignatory' => function ($q) {
                            $q->select('*');
                        }, 'company' => function ($q) {
                            $q->select('*');
                        }
                    ])->first();


                    $user_full_name = $promotion_value->first_name . " " . $promotion_value->last_name;


                    $employee_name = array(
                        'pro_emp_id' => $user_full_name,
                    );
                    $pro_dep_id = array(
                        'pro_dep_id' => $department_details->department_name,
                    );

                    $pro_desi_id  = array(
                        'pro_desi_id' => $designation_details->designation_name,
                    );
                    $pro_subject  = array(
                        'pro_subject' => $probation->probationLetterFormat->probation_letter_format_subject ?? '',
                    );
                    $pro_body  = array(
                        'pro_body' => $probation->probationLetterFormat->probation_letter_format_body ?? '',
                    );
                    $pro_extra_feature  = array(
                        'pro_extra_feature' => $probation->probationLetterFormat->probation_letter_format_extra_feature ?? '',
                    );
                    $pro_extra_signature  = array(
                        'pro_extra_signature' => $probation->probationLetterFormat->probation_letter_format_signature ?? '',
                    );
                    $pro_signature_first  = array(
                        'pro_signature_first' => $probation->probationLetterFormat->probitionSignatory->first_name ?? '',
                    );
                    $pro_signature_last  = array(
                        'pro_signature_last' => $probation->probationLetterFormat->probitionSignatory->last_name ?? '',
                    );
                    $company_name  = array(
                        'company_name' => $probation->company->company_name ?? '',
                    );
                    $company_logo  = array(
                        'company_logo' => $probation->company->company_logo ?? '',
                    );

                    $pro_incre_salary = array(
                        'pro_incre_salary' =>  $probation->pro_incre_salary,
                    );
                    $pro_incre_date = array(
                        'pro_incre_date' =>  $probation->pro_expi_date,
                    );
                    $pro_basic_salary = array(
                        'pro_basic_salary' => $probation->salaryconfig->salary_config_basic_salary,
                    );
                    $gross_salary = array(
                        'gross_salary' => $probation->gross_salary,
                    );


                    $pdf = PDF::loadView('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ]);

                    Mail::send('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'receiver_name' => $receiver_name,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "promotion.pdf");
                    });
                }
            }
            return redirect()->back()->with('message', 'Confirmation successfully without salary');
        } elseif ($request->increment_salary_admin) {
            ProbationRecomendetion::where('id', $request->id)
                ->update([
                    'pro_com_id' => Auth::user()->com_id,
                    'question_1' => $request->question_1,
                    'question_2' => $request->question_2,
                    'question_3' => $request->question_3,
                    'pro_incre_salary' => $request->increment_salary_value_admin,
                    'pro_old_salary' => ($request->increment_salary_value_admin + $request->pro_old_salary),
                    'description' => $request->description,
                    'template_id' => $request->template_id,
                    'status' => 1,
                    'termination_status' => 0,
                    'supervisor_status' => 0,
                ]);
            User::where('id', $request->pro_emp_id)
                ->update([
                    'com_id' => Auth::user()->com_id,
                    'gross_salary' => ($request->increment_salary_value_admin + $request->pro_old_salary),
                    'probation_letter_format_id' => $request->template_id,
                ]);
            $salary_histroy = new SalaryHistory();
            $salary_histroy->salary_history_com_id = Auth::user()->com_id;
            $salary_histroy->salary_history_emp_id = $request->pro_emp_id;
            $salary_histroy->salary_history_previous_gross = $request->pro_old_salary;
            $salary_histroy->salary_history_gross = ($request->increment_salary_value_admin + $request->pro_old_salary);
            $salary_histroy->salary_historiy_increment_salary = $request->increment_salary_value_admin;
            $salary_histroy->save();
            $probation = ProbationRecomendetion::where('id', $request->id)->get();

            foreach ($probation as $probationValue) {

                $employee_details = User::where('id', $probationValue->pro_emp_id)->get();

                foreach ($employee_details as $promotion_value) {

                    $data["email"] = $promotion_value->email;
                    $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
                    $data["subject"] = "Promotion Letter";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );

                    $company_details = Company::where('id', $promotion_value->com_id)->first(['company_name', 'company_logo']);
                    $department_details = Department::where('id', $promotion_value->department_id)->first(['department_name']);
                    $designation_details = Designation::where('id', $promotion_value->designation_id)->first(['designation_name']);
                    $probation = ProbationRecomendetion::with('probationLetterFormat', 'salaryconfig')->first();
                    $probation = ProbationRecomendetion::select("*")->with([
                        'probationLetterFormat' => function ($q) {
                            $q->select('*');
                        }, 'probationLetterFormat.probitionSignatory' => function ($q) {
                            $q->select('*');
                        }, 'company' => function ($q) {
                            $q->select('*');
                        }
                    ])->first();


                    $user_full_name = $promotion_value->first_name . " " . $promotion_value->last_name;


                    $employee_name = array(
                        'pro_emp_id' => $user_full_name,
                    );
                    $pro_dep_id = array(
                        'pro_dep_id' => $department_details->department_name,
                    );

                    $pro_desi_id  = array(
                        'pro_desi_id' => $designation_details->designation_name,
                    );
                    $pro_subject  = array(
                        'pro_subject' => $probation->probationLetterFormat->probation_letter_format_subject ?? '',
                    );
                    $pro_body  = array(
                        'pro_body' => $probation->probationLetterFormat->probation_letter_format_body ?? '',
                    );
                    $pro_extra_feature  = array(
                        'pro_extra_feature' => $probation->probationLetterFormat->probation_letter_format_extra_feature ?? '',
                    );
                    $pro_extra_signature  = array(
                        'pro_extra_signature' => $probation->probationLetterFormat->probation_letter_format_signature ?? '',
                    );
                    $pro_signature_first  = array(
                        'pro_signature_first' => $probation->probationLetterFormat->probitionSignatory->first_name ?? '',
                    );
                    $pro_signature_last  = array(
                        'pro_signature_last' => $probation->probationLetterFormat->probitionSignatory->last_name ?? '',
                    );
                    $company_name  = array(
                        'company_name' => $probation->company->company_name ?? '',
                    );
                    $company_logo  = array(
                        'company_logo' => $probation->company->company_logo ?? '',
                    );

                    $pro_incre_salary = array(
                        'pro_incre_salary' =>  $probation->pro_incre_salary,
                    );
                    $pro_incre_date = array(
                        'pro_incre_date' =>  $probation->pro_expi_date,
                    );
                    $pro_basic_salary = array(
                        'pro_basic_salary' => $probation->salaryconfig->salary_config_basic_salary,
                    );
                    $gross_salary = array(
                        'gross_salary' => $probation->gross_salary,
                    );


                    $pdf = PDF::loadView('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ]);

                    Mail::send('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'receiver_name' => $receiver_name,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "promotion.pdf");
                    });
                }
            }
            return redirect()->back()->with('message', 'Confirmation successfully with salary');
        } elseif ($request->check2) {
            $user = User::select(['id', 'email', 'phone', 'username'])
                ->where('id', $request->pro_emp_id)
                ->first();
            $inactive_email = $user->email;
            $inactive_phone = $user->phone;
            User::where('id', $request->pro_emp_id)
                ->update([
                    'com_id' => Auth::user()->com_id,
                    'inactive_email' => $inactive_email,
                    'inactive_phone' => $inactive_phone,
                    'inactive_username' => $user->username,
                    'is_active' => 0,
                ]);
            ProbationRecomendetion::where('id', $request->id)
                ->update([
                    'pro_com_id' => Auth::user()->com_id,
                    'question_1' => $request->question_1,
                    'question_2' => $request->question_2,
                    'question_3' => $request->question_3,
                    'description' => $request->description,
                    'template_id' => $request->template_id,
                    'termination_status' => 1,
                    'supervisor_status' => 0,

                ]);
            return redirect()->back()->with('message', 'Termination successfully');
        } elseif ($request->check3) {
            ProbationRecomendetion::where('id', $request->id)
                ->update([
                    'pro_com_id' => Auth::user()->com_id,
                    'question_1' => $request->question_1,
                    'question_2' => $request->question_2,
                    'question_3' => $request->question_3,
                    'description' => $request->description,
                    'template_id' => $request->template_id,
                    'pro_expi_date' => Carbon::parse($request->approve_expi_date)->addMonth($request->enxtend_month_admin)->format('Y-m-d'),
                    'pro_month_admin' => $request->approve_pro_month + $request->enxtend_month_admin,
                    'status' => 1,
                    'termination_status' => 0,
                    'supervisor_status' => 0,

                ]);
            User::where('id', $request->pro_emp_id)
                ->update([
                    'com_id' => Auth::user()->com_id,
                    'probation_expiry_date' => Carbon::parse($request->approve_expi_date)->addMonth($request->enxtend_month_admin)->format('Y-m-d'),
                    'probation_letter_format_id' => $request->template_id
                ]);
            $probation = ProbationRecomendetion::where('id', $request->id)->get();

            foreach ($probation as $probationValue) {

                $employee_details = User::where('id', $probationValue->pro_emp_id)->get();

                foreach ($employee_details as $promotion_value) {

                    $data["email"] = $promotion_value->email;
                    $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
                    $data["subject"] = "Promotion Letter";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );

                    $company_details = Company::where('id', $promotion_value->com_id)->first(['company_name', 'company_logo']);
                    $department_details = Department::where('id', $promotion_value->department_id)->first(['department_name']);
                    $designation_details = Designation::where('id', $promotion_value->designation_id)->first(['designation_name']);
                    $probation = ProbationRecomendetion::with('probationLetterFormat', 'salaryconfig')->first();
                    $probation = ProbationRecomendetion::select("*")->with([
                        'probationLetterFormat' => function ($q) {
                            $q->select('*');
                        }, 'probationLetterFormat.probitionSignatory' => function ($q) {
                            $q->select('*');
                        }, 'company' => function ($q) {
                            $q->select('*');
                        }
                    ])->first();


                    $user_full_name = $promotion_value->first_name . " " . $promotion_value->last_name;


                    $employee_name = array(
                        'pro_emp_id' => $user_full_name,
                    );
                    $pro_dep_id = array(
                        'pro_dep_id' => $department_details->department_name,
                    );

                    $pro_desi_id  = array(
                        'pro_desi_id' => $designation_details->designation_name,
                    );
                    $pro_subject  = array(
                        'pro_subject' => $probation->probationLetterFormat->probation_letter_format_subject ?? '',
                    );
                    $pro_body  = array(
                        'pro_body' => $probation->probationLetterFormat->probation_letter_format_body ?? '',
                    );
                    $pro_extra_feature  = array(
                        'pro_extra_feature' => $probation->probationLetterFormat->probation_letter_format_extra_feature ?? '',
                    );
                    $pro_extra_signature  = array(
                        'pro_extra_signature' => $probation->probationLetterFormat->probation_letter_format_signature ?? '',
                    );
                    $pro_signature_first  = array(
                        'pro_signature_first' => $probation->probationLetterFormat->probitionSignatory->first_name ?? '',
                    );
                    $pro_signature_last  = array(
                        'pro_signature_last' => $probation->probationLetterFormat->probitionSignatory->last_name ?? '',
                    );
                    $company_name  = array(
                        'company_name' => $probation->company->company_name ?? '',
                    );
                    $company_logo  = array(
                        'company_logo' => $probation->company->company_logo ?? '',
                    );

                    $pro_incre_salary = array(
                        'pro_incre_salary' =>  $probation->pro_incre_salary,
                    );
                    $pro_incre_date = array(
                        'pro_incre_date' =>  $probation->pro_expi_date,
                    );
                    $pro_basic_salary = array(
                        'pro_basic_salary' => $probation->salaryconfig->salary_config_basic_salary,
                    );
                    $gross_salary = array(
                        'gross_salary' => $probation->gross_salary,
                    );


                    $pdf = PDF::loadView('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ]);

                    Mail::send('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'receiver_name' => $receiver_name,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "promotion.pdf");
                    });
                }
            }
            return redirect()->back()->with('message', 'Extend successfully');
        } elseif ($request->employee_previous_designation) {
            // return $request->all();
            $promotion = new Promotion();
            $promotion->promotion_com_id = Auth::user()->com_id;
            $promotion->promotion_employee_id = $request->employee_previous_designation_pro_emp_id;
            $promotion->promotion_old_department = $request->employee_previous_department_id;
            $promotion->promotion_new_department = $request->new_department_id;
            $promotion->promotion_old_designation = $request->employee_previous_designation_id;
            $promotion->promotion_new_designation = $request->new_designation;
            $promotion->promotion_old_gross_salary = $request->employee_previous_salary;
            $promotion->promotion_new_gross_salary = $request->new_gross_salary;
            $promotion->save();

            $promoted_employee = User::find($request->employee_previous_designation_pro_emp_id);
            $promoted_employee->probation_letter_format_id = $request->template_field1_admin;
            if ($request->new_gross_salary) {
                $promoted_employee->gross_salary = $request->new_gross_salary + $request->employee_previous_salary;
            }
            if ($request->new_department_id) {
                $promoted_employee->department_id = $request->new_department_id;
            }
            if ($request->new_designation) {
                $promoted_employee->designation_id = $request->new_designation;
            }
            $promoted_employee->save();
            ProbationRecomendetion::where('id', $request->employee_previous_designation_edit_id)
                ->update([
                    'pro_com_id' => Auth::user()->com_id,
                    'question_1' => $request->output_field1_admin,
                    'question_2' => $request->output_field2_admin,
                    'question_3' => $request->output_field3_admin,
                    'description' => $request->description_field1_admin,
                    'pro_dep_id_admin' => $request->new_department_id,
                    'pro_desi_id_admin' => $request->new_designation,
                    'template_id' => $request->template_field1_admin,
                    'pro_incre_salary_admin' => $request->new_gross_salary,
                    'pro_old_salary_admin' => ($request->new_gross_salary + $request->employee_previous_salary),
                    'employee_previous_designation_admin' => $request->employee_previous_designation_id,
                    'status' => 1,
                    'termination_status' => 0,
                    'supervisor_status' => 0,
                ]);
            $salary_histroy = new SalaryHistory();
            $salary_histroy->salary_history_com_id = Auth::user()->com_id;
            $salary_histroy->salary_history_emp_id = $request->employee_previous_designation_pro_emp_id;
            $salary_histroy->salary_history_previous_gross = $request->employee_previous_salary;
            $salary_histroy->salary_history_gross = ($request->new_gross_salary + $request->employee_previous_salary);
            $salary_histroy->salary_historiy_increment_salary = $request->new_gross_salary;
            $salary_histroy->save();
            $probation = ProbationRecomendetion::where('id', $request->id)->get();

            foreach ($probation as $probationValue) {

                $employee_details = User::where('id', $probationValue->pro_emp_id)->get();

                foreach ($employee_details as $promotion_value) {

                    $data["email"] = $promotion_value->email;
                    $data["request_receiver_name"] =   $promotion_value->first_name . ' ' .  $promotion_value->last_name;
                    $data["subject"] = "Promotion Letter";
                    $receiver_name = array(
                        'receiver_name_value' => $data["request_receiver_name"],
                    );

                    $company_details = Company::where('id', $promotion_value->com_id)->first(['company_name', 'company_logo']);
                    $department_details = Department::where('id', $promotion_value->department_id)->first(['department_name']);
                    $designation_details = Designation::where('id', $promotion_value->designation_id)->first(['designation_name']);
                    $probation = ProbationRecomendetion::with('probationLetterFormat', 'salaryconfig')->first();
                    $probation = ProbationRecomendetion::select("*")->with([
                        'probationLetterFormat' => function ($q) {
                            $q->select('*');
                        }, 'probationLetterFormat.probitionSignatory' => function ($q) {
                            $q->select('*');
                        }, 'company' => function ($q) {
                            $q->select('*');
                        }
                    ])->first();


                    $user_full_name = $promotion_value->first_name . " " . $promotion_value->last_name;


                    $employee_name = array(
                        'pro_emp_id' => $user_full_name,
                    );
                    $pro_dep_id = array(
                        'pro_dep_id' => $department_details->department_name,
                    );

                    $pro_desi_id  = array(
                        'pro_desi_id' => $designation_details->designation_name,
                    );
                    $pro_subject  = array(
                        'pro_subject' => $probation->probationLetterFormat->probation_letter_format_subject ?? '',
                    );
                    $pro_body  = array(
                        'pro_body' => $probation->probationLetterFormat->probation_letter_format_body ?? '',
                    );
                    $pro_extra_feature  = array(
                        'pro_extra_feature' => $probation->probationLetterFormat->probation_letter_format_extra_feature ?? '',
                    );
                    $pro_extra_signature  = array(
                        'pro_extra_signature' => $probation->probationLetterFormat->probation_letter_format_signature ?? '',
                    );
                    $pro_signature_first  = array(
                        'pro_signature_first' => $probation->probationLetterFormat->probitionSignatory->first_name ?? '',
                    );
                    $pro_signature_last  = array(
                        'pro_signature_last' => $probation->probationLetterFormat->probitionSignatory->last_name ?? '',
                    );
                    $company_name  = array(
                        'company_name' => $probation->company->company_name ?? '',
                    );
                    $company_logo  = array(
                        'company_logo' => $probation->company->company_logo ?? '',
                    );

                    $pro_incre_salary = array(
                        'pro_incre_salary' =>  $probation->pro_incre_salary,
                    );
                    $pro_incre_date = array(
                        'pro_incre_date' =>  $probation->pro_expi_date,
                    );
                    $pro_basic_salary = array(
                        'pro_basic_salary' => $probation->salaryconfig->salary_config_basic_salary,
                    );
                    $gross_salary = array(
                        'gross_salary' => $probation->gross_salary,
                    );


                    $pdf = PDF::loadView('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ]);

                    Mail::send('back-end.premium.emails.probationMail', [
                        'company_name' => $company_name,
                        'employee_name' => $employee_name,
                        'pro_dep_id' => $pro_dep_id,
                        'pro_desi_id' => $pro_desi_id,
                        'pro_incre_salary' => $pro_incre_salary,
                        'receiver_name' => $receiver_name,
                        'pro_subject' => $pro_subject,
                        'pro_body' => $pro_body,
                        'pro_basic_salary' => $pro_basic_salary,
                        'gross_salary' => $gross_salary,
                        'pro_incre_date' => $pro_incre_date,
                        'pro_extra_feature' => $pro_extra_feature,
                        'pro_extra_signature' => $pro_extra_signature,
                        'pro_signature_last' => $pro_signature_last,
                        'pro_signature_first' => $pro_signature_first,
                        'company_logo' => $company_logo,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_receiver_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "promotion.pdf");
                    });
                }
            }
            return redirect()->back()->with('message', 'Promotion successfully');
        }
    }

    public function employeeRecommendationDownload($id)
    {
        $empId = ProbationRecomendetion::where('id', $id)->first('pro_emp_id');
        $probation = User::where('com_id', Auth::user()->com_id)
            ->where('id', $empId->pro_emp_id)
            ->first();
        $incrementSalary = ProbationRecomendetion::with('recDepartment','recDepartmentAdmin','recDesignationAdmin')->where('pro_com_id', Auth::user()->com_id)
            ->where('id', $id)
            ->first();
        $employees = User::where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', 1)->where('id', '=', $empId->pro_emp_id)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->orderBy('id', 'DESC')
            ->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'joining_date', 'designation_id', 'phone', 'address', 'gross_salary', 'com_id', 'mobile_bill', 'probation_letter_format_id']);
        $fileName = "Probation-letter-" . $probation->company_assigned_id . ".pdf";
        $footer = $probation->probationLetter->probation_letter_format_footer ?? null;
        $logo_header = asset($probation->company->company_logo ?? null);

        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'nikosh',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P',
            'padding-top' => '30',
        ]);
        $html = \View::make('back-end.premium.probation.download-pdf', get_defined_vars());
        $html = $html->render();

        $htmlFooter = '<html><div>'
            . ' <div style="font-size: 10px;text-align:center;"> ' . $footer . ' </div>'
            . '</div></html>';

        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($fileName, 'D');
    }
}
