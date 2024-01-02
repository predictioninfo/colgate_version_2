<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Package;
use Illuminate\Http\Request;
use Auth;

class PermissionController extends Controller
{
    public function packagePermissionIndex($id, $package_name)
    {

        // echo "ok"; exit;

        $package_id = $id;
        //echo $package_name = $package_name; exit;
        return view('back-end.premium.company.package.package-permission-index', [

            'package_id' => $package_id,
            'package_name' => $package_name,
        ]);
    }

    public function packageGivingPermission(Request $request)
    {

        try {
            $package_content_array = [
                [

                    $request->dashboard_module,
                    $request->user_module,
                    $request->user_sub_module_one,
                    $request->user_sub_module_two,
                    $request->user_sub_module_three,

                    $request->employee_module,
                    $request->employee_sub_module_one,
                    $request->employee_sub_module_two,

                    $request->customize_module,
                    $request->customize_sub_module_one,
                    $request->customize_sub_module_two,
                    $request->customize_sub_module_three,
                    $request->customize_sub_module_four,
                    $request->customize_sub_module_five,
                    $request->customize_sub_module_six,
                    $request->customize_sub_module_eight,
                    $request->customize_sub_module_nine,
                    $request->customize_sub_module_ten,
                    $request->customize_sub_module_eleven,
                    $request->customize_sub_module_sixteen,
                    $request->customize_sub_module_seventeen,

                    $request->template_module,
                    $request->template_sub_module_one,
                    $request->template_sub_module_two,
                    $request->template_sub_module_three,
                    $request->template_sub_module_four,
                    $request->template_sub_module_five,
                    $request->template_sub_module_six,
                    $request->template_sub_module_seven,
                    $request->template_sub_module_eight,
                    $request->template_sub_module_nine,
                    $request->template_sub_module_ten,
                    $request->template_sub_module_eleven,




                    $request->customize_sub_module_tweenty_two,
                    $request->customize_sub_module_tweenty_three,
                    $request->customize_sub_module_tweenty_four,

                    $request->customize_sub_module_tweenty_five,
                    $request->customize_sub_module_tweenty_six,
                    $request->customize_sub_module_tweenty_seven,
                    $request->customize_sub_module_tweenty_eight,
                    $request->customize_sub_module_tweenty_nine,




                    $request->core_hr_module,
                    $request->core_hr_sub_module_one,
                    $request->core_hr_sub_module_two,
                    $request->core_hr_sub_module_three,
                    $request->core_hr_sub_module_four,
                    $request->core_hr_sub_module_five,
                    $request->core_hr_sub_module_six,
                    $request->core_hr_sub_module_seven,
                    $request->core_hr_sub_module_eight,
                    $request->core_hr_sub_module_nine,
                    $request->core_hr_sub_module_ten,
                    $request->core_hr_sub_module_eleven,
                    $request->core_hr_sub_module_twelve,
                    $request->core_hr_sub_module_thirteen,
                    $request->core_hr_sub_module_fourteen,
                    $request->core_hr_sub_module_fifteen,
                    $request->core_hr_sub_module_sixteen,


                    $request->organization_module,
                    $request->organization_sub_module_one,
                    $request->organization_sub_module_two,
                    $request->organization_sub_module_three,
                    $request->organization_sub_module_four,
                    $request->organization_sub_module_five,
                    $request->organization_sub_module_six,
                    $request->organization_sub_module_seven,
                    $request->organization_sub_module_eight,
                    $request->organization_sub_module_twentytwo,
                    $request->organization_sub_module_twentythree,
                    $request->organization_sub_module_twentyfour,

                    $request->customize_sub_module_fourteen,
                    $request->customize_sub_module_fifteen,

                    $request->organization_sub_module_twelve,
                    $request->organization_sub_module_thirteen,
                    $request->organization_sub_module_fourteen,
                    $request->organization_sub_module_fifteen,
                    $request->organization_sub_module_sixteen,
                    $request->organization_sub_module_seventeen,
                    // $request->organization_sub_module_eighteen,
                    // $request->organization_sub_module_nineteen,
                    // $request->organization_sub_module_twenty,
                    // $request->organization_sub_module_twentyone,

                    $request->organization_sub_module_nine,
                    $request->organization_sub_module_ten,
                    $request->organization_sub_module_eleven,

                    $request->time_sheet_module,
                    $request->time_sheet_sub_module_one,
                    $request->time_sheet_sub_module_two,
                    $request->time_sheet_sub_module_three,
                    $request->time_sheet_sub_module_tweleve,
                    $request->time_sheet_sub_module_four,
                    $request->time_sheet_sub_module_five,
                    $request->time_sheet_sub_module_six,
                    $request->time_sheet_sub_module_seven,
                    $request->time_sheet_sub_module_eight,
                    $request->time_sheet_sub_module_nine,
                    $request->time_sheet_sub_module_ten,
                    $request->time_sheet_sub_module_eleven,


                    $request->customize_payroll_setting_module,
                    $request->customize_payroll_setting_sub_module_one,
                    $request->customize_payroll_setting_sub_module_two,
                    $request->customize_payroll_setting_sub_module_three,
                    $request->customize_payroll_setting_sub_module_four,
                    $request->customize_payroll_setting_sub_module_five,
                    $request->customize_payroll_setting_sub_module_six,
                    $request->customize_payroll_setting_sub_module_seven,
                    $request->customize_payroll_setting_sub_module_eight,


                    $request->payroll_module,
                    $request->payroll_sub_module_one,
                    $request->payroll_sub_module_two,
                    $request->payroll_sub_module_three,
                    $request->payroll_sub_module_four,
                    $request->payroll_sub_module_five,

                    $request->payroll_sub_module_eight,
                    $request->payroll_sub_module_nine,


                    $request->payroll_sub_module_six,
                    $request->payroll_sub_module_seven,



                    $request->hr_calander_module,

                    $request->hr_report_module,
                    $request->hr_report_sub_module_one,
                    $request->hr_report_sub_module_two,
                    $request->hr_report_sub_module_three,
                    $request->hr_report_sub_module_four,
                    $request->hr_report_sub_module_five,
                    $request->hr_report_sub_module_six,
                    $request->hr_report_sub_module_seven,
                    $request->hr_report_sub_module_eight,
                    $request->hr_report_sub_module_nine,
                    $request->hr_report_sub_module_ten,

                    $request->hr_report_sub_module_eleven,
                    $request->hr_report_sub_module_twelve,
                    $request->hr_report_sub_module_thirteen,
                    $request->hr_report_sub_module_fourteen,
                    $request->hr_report_sub_module_fifteen,
                    $request->hr_report_sub_module_sixteen,
                    $request->hr_report_sub_module_seventeen,
                    $request->hr_report_sub_module_eighteen,
                    $request->hr_report_sub_module_nineteen,




                    $request->event_and_meeting_module,
                    $request->event_and_meeting_sub_module_one,
                    $request->event_and_meeting_sub_module_two,

                    $request->project_management_module,
                    $request->project_management_sub_module_one,
                    $request->project_management_sub_module_two,

                    $request->support_ticket_module,

                    $request->assets_module,
                    $request->assets_sub_module_one,
                    $request->assets_sub_module_two,

                    $request->file_manager_module,
                    $request->file_manager_sub_module_one,
                    $request->file_manager_sub_module_two,
                    $request->file_manager_sub_module_three,

                    $request->performance_module,
                    $request->performance_sub_module_one,
                    $request->performance_sub_module_two,
                    $request->performance_sub_module_three,
                    $request->performance_sub_module_four,
                    $request->performance_sub_module_five,
                    $request->performance_sub_module_six,
                    $request->performance_sub_module_seven,
                    $request->performance_sub_module_eight,
                    $request->performance_sub_module_nine,
                    $request->performance_sub_module_ten,
                    $request->performance_sub_module_eleven,
                    $request->performance_sub_module_eleven_add,
                    $request->performance_sub_module_eleven_edit,
                    $request->performance_sub_module_eleven_delete,
                    $request->performance_sub_module_twelve,

                    $request->recruitment_module,
                    $request->recruitment_sub_module_one,
                    $request->recruitment_sub_module_two,
                    $request->recruitment_sub_module_three,

                    $request->training_module,
                    $request->training_sub_module_one,
                    $request->training_sub_module_two,
                    $request->training_sub_module_three,

                    $request->probation_module,
                    $request->core_probation_sub_module_one,
                    $request->core_probation_sub_module_two,

                ]
            ];



            foreach ($package_content_array as $package_content_array_value) {

                $package = Package::find($request->package_id);
                $package->package_module = json_encode($package_content_array_value);
                $package->save();
            }

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function givingPermission(Request $request)
    {


        //echo $request->user_sub_module_one_add; exit;

        try {
            $content_array = [
                [

                    $request->dashboard_module,
                    $request->user_settings_panel,
                    $request->user_module,
                    $request->user_sub_module_one,
                    $request->user_sub_module_one_add,
                    $request->user_sub_module_one_edit,
                    $request->user_sub_module_one_delete,
                    $request->user_sub_module_two,
                    $request->user_sub_module_three,

                    $request->employee_module,
                    $request->employee_sub_module_one,
                    $request->employee_sub_module_one_add,
                    $request->employee_sub_module_one_edit,
                    $request->employee_sub_module_one_delete,
                    $request->employee_sub_module_two,

                    $request->customize_module,
                    $request->customize_sub_module_one,
                    $request->customize_sub_module_one_add,
                    $request->customize_sub_module_one_edit,
                    $request->customize_sub_module_one_delete,
                    $request->customize_sub_module_one_permission,
                    $request->customize_sub_module_one_permission_giving,
                    $request->customize_sub_module_two,
                    $request->customize_sub_module_three,
                    $request->customize_sub_module_three_add,
                    $request->customize_sub_module_three_edit,
                    $request->customize_sub_module_three_delete,
                    $request->customize_sub_module_four,
                    $request->customize_sub_module_four_add,
                    $request->customize_sub_module_four_edit,
                    $request->customize_sub_module_four_delete,
                    $request->customize_sub_module_five,
                    $request->customize_sub_module_five_add,
                    $request->customize_sub_module_five_edit,
                    $request->customize_sub_module_five_delete,
                    $request->customize_sub_module_six,
                    $request->customize_sub_module_six_add,
                    $request->customize_sub_module_six_edit,
                    $request->customize_sub_module_six_delete,
                    $request->customize_sub_module_eight,
                    $request->customize_sub_module_eight_add,
                    $request->customize_sub_module_eight_edit,
                    $request->customize_sub_module_eight_delete,
                    $request->customize_sub_module_nine,
                    $request->customize_sub_module_nine_add,
                    $request->customize_sub_module_nine_edit,
                    $request->customize_sub_module_nine_delete,
                    $request->customize_sub_module_ten,
                    $request->customize_sub_module_ten_add,
                    $request->customize_sub_module_ten_edit,
                    $request->customize_sub_module_ten_delete,
                    $request->customize_sub_module_eleven,
                    $request->customize_sub_module_eleven_add,
                    $request->customize_sub_module_eleven_edit,
                    $request->customize_sub_module_eleven_delete,
                    $request->customize_sub_module_twelve,
                    $request->customize_sub_module_twelve_add,
                    $request->customize_sub_module_twelve_edit,
                    $request->customize_sub_module_twelve_delete,
                    $request->customize_sub_module_thirteen,
                    $request->customize_sub_module_thirteen_add,
                    $request->customize_sub_module_thirteen_edit,
                    $request->customize_sub_module_thirteen_delete,
                    $request->customize_sub_module_sixteen,
                    $request->customize_sub_module_sixteen_add,
                    $request->customize_sub_module_sixteen_edit,
                    $request->customize_sub_module_sixteen_delete,
                    $request->customize_sub_module_seventeen,
                    $request->customize_sub_module_seventeen_add,
                    $request->customize_sub_module_seventeen_edit,
                    $request->customize_sub_module_seventeen_delete,

                    $request->customize_sub_module_eighteen,
                    $request->customize_sub_module_eighteen_add,
                    $request->customize_sub_module_eighteen_edit,
                    $request->customize_sub_module_eighteen_delete,

                    $request->customize_sub_module_nineteen,
                    $request->customize_sub_module_nineteen_add,
                    $request->customize_sub_module_nineteen_edit,
                    $request->customize_sub_module_nineteen_delete,

                    $request->customize_sub_module_tweenty,
                    $request->customize_sub_module_tweenty_add,
                    $request->customize_sub_module_tweenty_edit,
                    $request->customize_sub_module_tweenty_delete,

                    $request->customize_sub_module_tweenty_one,
                    $request->customize_sub_module_tweenty_one_add,
                    $request->customize_sub_module_tweenty_one_edit,
                    $request->customize_sub_module_tweenty_one_delete,

                    $request->customize_sub_module_tweenty_two,
                    $request->customize_sub_module_tweenty_two_add,
                    $request->customize_sub_module_tweenty_two_edit,
                    $request->customize_sub_module_tweenty_two_delete,

                    $request->customize_sub_module_tweenty_three,
                    $request->customize_sub_module_tweenty_three_add,

                    $request->customize_sub_module_tweenty_three_add,

                    $request->customize_sub_module_tweenty_four,
                    $request->customize_sub_module_tweenty_four_add,
                    $request->customize_sub_module_tweenty_four_edit,
                    $request->customize_sub_module_tweenty_four_delete,

                    $request->customize_sub_module_tweenty_five,
                    $request->customize_sub_module_tweenty_five_add,

                    $request->customize_sub_module_tweenty_six,
                    $request->customize_sub_module_tweenty_six_add,

                    $request->customize_sub_module_tweenty_seven,
                    $request->customize_sub_module_tweenty_seven_add,

                    $request->customize_sub_module_tweenty_eight,
                    $request->customize_sub_module_tweenty_eight_add,
                    $request->customize_sub_module_tweenty_eight_edit,
                    $request->customize_sub_module_tweenty_eight_delete,

                    $request->customize_sub_module_tweenty_nine,
                    $request->customize_sub_module_tweenty_nine_add,
                    $request->customize_sub_module_tweenty_nine_edit,
                    $request->customize_sub_module_tweenty_nine_delete,




                    $request->organization_sub_module_twentytwo,
                    $request->organization_sub_module_twentythree,

                    $request->organization_sub_module_twentyfour,
                    $request->organization_sub_module_twentyfour_add,
                    $request->organization_sub_module_twentyfour_edit,
                    $request->organization_sub_module_twentyfour_delete,

                    $request->core_hr_module,
                    $request->core_hr_sub_module_one,
                    $request->core_hr_sub_module_one_add,
                    $request->core_hr_sub_module_one_edit,
                    $request->core_hr_sub_module_one_delete,
                    $request->core_hr_sub_module_two,
                    $request->core_hr_sub_module_two_add,
                    $request->core_hr_sub_module_two_edit,
                    $request->core_hr_sub_module_two_delete,
                    $request->core_hr_sub_module_three,
                    $request->core_hr_sub_module_three_add,
                    $request->core_hr_sub_module_three_edit,
                    $request->core_hr_sub_module_three_delete,
                    $request->core_hr_sub_module_four,
                    $request->core_hr_sub_module_four_add,
                    $request->core_hr_sub_module_four_edit,
                    $request->core_hr_sub_module_four_delete,
                    $request->core_hr_sub_module_five,
                    $request->core_hr_sub_module_five_add,
                    $request->core_hr_sub_module_five_edit,
                    $request->core_hr_sub_module_five_delete,
                    $request->core_hr_sub_module_six,
                    $request->core_hr_sub_module_six_add,
                    $request->core_hr_sub_module_six_edit,
                    $request->core_hr_sub_module_six_delete,
                    $request->core_hr_sub_module_seven,
                    $request->core_hr_sub_module_seven_add,
                    $request->core_hr_sub_module_seven_edit,
                    $request->core_hr_sub_module_seven_delete,
                    $request->core_hr_sub_module_eight,
                    $request->core_hr_sub_module_eight_add,
                    $request->core_hr_sub_module_eight_edit,
                    $request->core_hr_sub_module_eight_delete,
                    $request->core_hr_sub_module_nine,
                    $request->core_hr_sub_module_ten,
                    $request->core_hr_sub_module_eleven,
                    $request->core_hr_sub_module_twelve,
                    $request->core_hr_sub_module_twelve_add,
                    $request->core_hr_sub_module_twelve_edit,
                    $request->core_hr_sub_module_twelve_delete,

                    $request->core_hr_sub_module_thirteen,
                    $request->core_hr_sub_module_thirteen_add,
                    $request->core_hr_sub_module_thirteen_edit,
                    $request->core_hr_sub_module_thirteen_delete,

                    $request->core_hr_sub_module_fourteen,
                    $request->core_hr_sub_module_fourteen_add,
                    $request->core_hr_sub_module_fourteen_edit,
                    $request->core_hr_sub_module_fourteen_delete,

                    $request->core_hr_sub_module_fifteen,
                    $request->core_hr_sub_module_sixteen,


                    $request->organization_module,
                    $request->organization_sub_module_one,
                    $request->organization_sub_module_two,
                    $request->organization_sub_module_two_add,
                    $request->organization_sub_module_two_edit,
                    $request->organization_sub_module_two_delete,
                    $request->organization_sub_module_three,
                    $request->organization_sub_module_three_add,
                    $request->organization_sub_module_three_edit,
                    $request->organization_sub_module_three_delete,
                    $request->organization_sub_module_four,
                    $request->organization_sub_module_four_add,
                    $request->organization_sub_module_four_edit,
                    $request->organization_sub_module_four_delete,
                    $request->organization_sub_module_five,
                    $request->organization_sub_module_five_add,
                    $request->organization_sub_module_five_edit,
                    $request->organization_sub_module_five_delete,
                    $request->organization_sub_module_six,
                    $request->organization_sub_module_six_add,
                    $request->organization_sub_module_six_edit,
                    $request->organization_sub_module_six_delete,
                    $request->organization_sub_module_seven,
                    $request->organization_sub_module_seven_add,
                    $request->organization_sub_module_seven_edit,
                    $request->organization_sub_module_seven_delete,
                    $request->organization_sub_module_eight,
                    $request->organization_sub_module_eight_add,
                    $request->organization_sub_module_eight_edit,
                    $request->organization_sub_module_eight_delete,

                    $request->organization_sub_module_twelve,
                    $request->organization_sub_module_twelve_add,
                    $request->organization_sub_module_twelve_update,
                    $request->organization_sub_module_twelve_delete,

                    $request->organization_sub_module_thirteen,
                    $request->organization_sub_module_thirteen_add,
                    $request->organization_sub_module_thirteen_update,
                    $request->organization_sub_module_thirteen_delete,

                    $request->organization_sub_module_fourteen,
                    $request->organization_sub_module_fourteen_add,
                    $request->organization_sub_module_fourteen_update,
                    $request->organization_sub_module_fourteen_delete,

                    $request->organization_sub_module_fifteen,
                    $request->organization_sub_module_fifteen_add,
                    $request->organization_sub_module_fifteen_update,
                    $request->organization_sub_module_fifteen_delete,

                    $request->organization_sub_module_sixteen,
                    $request->organization_sub_module_sixteen_add,
                    $request->organization_sub_module_sixteen_update,
                    $request->organization_sub_module_sixteen_delete,

                    $request->organization_sub_module_seventeen,
                    $request->organization_sub_module_seventeen_add,
                    $request->organization_sub_module_seventeen_update,
                    $request->organization_sub_module_seventeen_delete,
                    // $request->organization_sub_module_eighteen,
                    // $request->organization_sub_module_nineteen,
                    // $request->organization_sub_module_twenty,
                    // $request->organization_sub_module_twentyone,

                    $request->organization_sub_module_nine,
                    $request->organization_sub_module_nine_add,
                    $request->organization_sub_module_nine_edit,
                    $request->organization_sub_module_nine_delete,
                    $request->organization_sub_module_ten,
                    $request->organization_sub_module_ten_add,
                    $request->organization_sub_module_ten_edit,
                    $request->organization_sub_module_ten_delete,

                    $request->organization_sub_module_eleven,
                    $request->organization_sub_module_eleven_add,
                    $request->organization_sub_module_eleven_edit,
                    $request->organization_sub_module_eleven_delete,

                    $request->customize_sub_module_fourteen,
                    $request->customize_sub_module_fourteen_add,
                    $request->customize_sub_module_fourteen_edit,
                    $request->customize_sub_module_fourteen_delete,

                    $request->ccustomize_sub_module_fifteen,
                    $request->ccustomize_sub_module_fifteen_add,
                    $request->ccustomize_sub_module_fifteen_edit,
                    $request->ccustomize_sub_module_fifteen_delete,


                    $request->time_sheet_module,
                    $request->time_sheet_sub_module_one,
                    $request->time_sheet_sub_module_two,
                    $request->time_sheet_sub_module_three,
                    $request->time_sheet_sub_module_tweleve,
                    $request->time_sheet_sub_module_four,
                    $request->time_sheet_sub_module_five,
                    $request->time_sheet_sub_module_six,
                    $request->time_sheet_sub_module_six_add,
                    $request->time_sheet_sub_module_six_edit,
                    $request->time_sheet_sub_module_six_delete,
                    $request->time_sheet_sub_module_seven,
                    $request->time_sheet_sub_module_seven_add,
                    $request->time_sheet_sub_module_seven_edit,
                    $request->time_sheet_sub_module_seven_delete,
                    $request->time_sheet_sub_module_eight,
                    $request->time_sheet_sub_module_eight_add,
                    $request->time_sheet_sub_module_eight_edit,
                    $request->time_sheet_sub_module_eight_delete,
                    $request->time_sheet_sub_module_nine,
                    $request->time_sheet_sub_module_nine_add,
                    $request->time_sheet_sub_module_nine_edit,
                    $request->time_sheet_sub_module_seven_delete,
                    $request->time_sheet_sub_module_nine_delete,
                    $request->time_sheet_sub_module_ten,
                    $request->time_sheet_sub_module_ten_add,
                    $request->time_sheet_sub_module_ten_edit,
                    $request->time_sheet_sub_module_ten_delete,
                    $request->time_sheet_sub_module_eleven,


                    $request->customize_payroll_setting_module,
                    $request->customize_payroll_setting_sub_module_one,
                    $request->customize_payroll_setting_sub_module_two,
                    $request->customize_payroll_setting_sub_module_three,
                    $request->customize_payroll_setting_sub_module_four,
                    $request->customize_payroll_setting_sub_module_five,
                    $request->customize_payroll_setting_sub_module_six,
                    $request->customize_payroll_setting_sub_module_seven,
                    $request->customize_payroll_setting_sub_module_eight,



                    $request->payroll_module,
                    $request->payroll_sub_module_one,
                    $request->payroll_sub_module_two,
                    $request->payroll_sub_module_three,
                    $request->payroll_sub_module_four,
                    $request->payroll_sub_module_five,
                    $request->payroll_sub_module_six,
                    $request->payroll_sub_module_seven,


                    $request->hr_calander_module,
                    $request->hr_report_module,
                    $request->hr_report_sub_module_one,
                    $request->hr_report_sub_module_two,
                    $request->hr_report_sub_module_three,
                    $request->hr_report_sub_module_four,
                    $request->hr_report_sub_module_five,
                    $request->hr_report_sub_module_six,
                    $request->hr_report_sub_module_seven,
                    $request->hr_report_sub_module_eight,
                    $request->hr_report_sub_module_nine,
                    $request->hr_report_sub_module_ten,

                    $request->hr_report_sub_module_eleven,
                    $request->hr_report_sub_module_twelve,
                    $request->hr_report_sub_module_thirteen,
                    $request->hr_report_sub_module_fourteen,
                    $request->hr_report_sub_module_fifteen,
                    $request->hr_report_sub_module_sixteen,
                    $request->hr_report_sub_module_seventeen,
                    $request->hr_report_sub_module_eighteen,
                    $request->hr_report_sub_module_nineteen,

                    $request->event_and_meeting_module,
                    $request->event_and_meeting_sub_module_one,
                    $request->event_and_meeting_sub_module_one_add,
                    $request->event_and_meeting_sub_module_one_edit,
                    $request->event_and_meeting_sub_module_one_delete,
                    $request->event_and_meeting_sub_module_two,
                    $request->event_and_meeting_sub_module_two_add,
                    $request->event_and_meeting_sub_module_two_edit,
                    $request->event_and_meeting_sub_module_two_delete,

                    $request->project_management_module,
                    $request->project_management_sub_module_one,
                    $request->project_management_sub_module_one_add,
                    $request->project_management_sub_module_one_edit,
                    $request->project_management_sub_module_one_delete,


                    $request->project_management_sub_module_two,
                    $request->project_management_sub_module_two_add,
                    $request->project_management_sub_module_two_edit,
                    $request->project_management_sub_module_two_delete,

                    $request->support_ticket_module,
                    $request->support_ticket_module_add,
                    $request->support_ticket_module_edit,
                    $request->support_ticket_module_delete,

                    $request->assets_module,
                    $request->assets_sub_module_one,
                    $request->assets_sub_module_one_add,
                    $request->assets_sub_module_one_edit,
                    $request->assets_sub_module_one_delete,
                    $request->assets_sub_module_two,
                    $request->assets_sub_module_two_add,
                    $request->assets_sub_module_two_edit,
                    $request->assets_sub_module_two_delete,

                    $request->file_manager_module,
                    $request->file_manager_sub_module_one,
                    $request->file_manager_sub_module_one_add,
                    $request->file_manager_sub_module_one_edit,
                    $request->file_manager_sub_module_one_delete,
                    $request->file_manager_sub_module_two,
                    $request->file_manager_sub_module_two_add,
                    $request->file_manager_sub_module_two_edit,
                    $request->file_manager_sub_module_two_delete,
                    $request->file_manager_sub_module_three,




                    $request->performance_module,
                    $request->performance_sub_module_one,
                    $request->performance_sub_module_two,
                    $request->performance_sub_module_three,
                    $request->performance_sub_module_four,
                    $request->performance_sub_module_five,
                    $request->performance_sub_module_six,
                    $request->performance_sub_module_seven,
                    $request->performance_sub_module_eight,
                    $request->performance_sub_module_nine,
                    $request->performance_sub_module_ten,
                    $request->performance_sub_module_eleven,

                    $request->performance_sub_module_eleven_add,
                    $request->performance_sub_module_eleven_edit,
                    $request->performance_sub_module_eleven_delete,

                    $request->performance_sub_module_twelve,




                    $request->performance_sub_module_one_add,
                    $request->performance_sub_module_one_edit,
                    $request->performance_sub_module_one_delete,

                    $request->performance_sub_module_two_add,
                    $request->performance_sub_module_two_edit,
                    $request->performance_sub_module_two_delete,

                    $request->performance_sub_module_three_add,
                    $request->performance_sub_module_three_edit,
                    $request->performance_sub_module_three_delete,

                    $request->performance_sub_module_four_add,
                    $request->performance_sub_module_four_edit,
                    $request->performance_sub_module_four_delete,

                    $request->performance_sub_module_five_add,
                    $request->performance_sub_module_five_edit,
                    $request->performance_sub_module_five_delete,

                    $request->performance_sub_module_six_add,
                    $request->performance_sub_module_six_edit,
                    $request->performance_sub_module_six_delete,

                    $request->performance_sub_module_seven_add,
                    $request->performance_sub_module_seven_edit,
                    $request->performance_sub_module_seven_delete,

                    $request->performance_sub_module_eight_add,
                    $request->performance_sub_module_eight_edit,
                    $request->performance_sub_module_eight_delete,


                    $request->recruitment_module,
                    $request->recruitment_sub_module_one,
                    $request->recruitment_sub_module_two,
                    $request->recruitment_sub_module_three,

                    $request->recruitment_sub_module_one_add,
                    $request->recruitment_sub_module_one_edit,
                    $request->recruitment_sub_module_one_delete,

                    $request->recruitment_sub_module_two_action,


                    $request->training_module,
                    $request->training_sub_module_one,
                    $request->training_sub_module_two,
                    $request->training_sub_module_three,


                    $request->training_sub_module_one_add,
                    $request->training_sub_module_one_edit,
                    $request->training_sub_module_one_delete,


                    $request->training_sub_module_two_add,
                    $request->training_sub_module_two_edit,
                    $request->training_sub_module_two_delete,


                    $request->training_sub_module_three_add,
                    $request->training_sub_module_three_edit,
                    $request->training_sub_module_three_delete,

                    $request->probation_module,
                    $request->probation_sub_module_one,
                    $request->probation_sub_module_two,
                    $request->probation_sub_module_three,


                ]
            ];



            foreach ($content_array as $array_value) {

                if (Permission::where('permission_com_id', Auth::user()->com_id)->where('permission_role_id', $request->permission_role_id)->exists()) {
                    $permission_id = Permission::where('permission_com_id', Auth::user()->com_id)->where('permission_role_id', $request->permission_role_id)->first('id');
                    $permission = Permission::find($permission_id->id);
                    $permission->permission_com_id = Auth::user()->com_id;
                    $permission->permission_role_id = $request->permission_role_id;
                    $permission->permission_content = json_encode($array_value);
                    $permission->save();
                } else {
                    $permission = new Permission();
                    $permission->permission_com_id = Auth::user()->com_id;
                    $permission->permission_role_id = $request->permission_role_id;
                    $permission->permission_content = json_encode($array_value);
                    $permission->save();
                }
            }

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}