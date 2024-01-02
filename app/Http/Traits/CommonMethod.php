<?php


namespace App\Http\traits;
use App\Models\Company;
use App\Models\User;
use Auth;
use DB;


Trait CommonMethod {


    public  function generateInvoiceId()
    {
        $employeeIdPrefix = Company::where('id', '=', Auth::user()->com_id)->first('employee_id_prefix');
        $prefix =  $employeeIdPrefix->employee_id_prefix ;

        $invoiceLength = 3 ;
        $totalEmployee= DB::table('users')->where('com_id', '=', Auth::user()->com_id)->count();
        $voucherId =  $prefix . str_pad($totalEmployee +1, $invoiceLength, "0", STR_PAD_LEFT);

        return $voucherId;
    }
}
