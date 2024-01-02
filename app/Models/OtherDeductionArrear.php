<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDeductionArrear extends Model
{
    use HasFactory;

    public function userDeductionArrear(){
        return $this->belongsTo(User::class,'other_deduction_arrear_emp_id');
    }
}